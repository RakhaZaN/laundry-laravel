<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $list_pesanan = Pesanan::orderBy('jadwal_pengambilan', 'desc')->orderBy('jadwal_pengantaran')->get();
        return view('menu.kasir', compact('list_pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        if ($request->has('layanan')) {
            $layanan = Layanan::find($request->layanan);
            return view('pesanan.create', compact('layanan'));
        }

        $layanan = Layanan::all();
        return view('pesanan.offline', ['list_layanan' => $layanan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanan,id',
            'nama_pelanggan' => 'required|string',
            'jadwal_pengambilan' => 'required',
            'jadwal_pengantaran' => 'required',
            'alamat' => 'required|string',
            'jumlah' => 'nullable|decimal:0,2',
            'harga' => 'required|integer',
            'total_biaya' => 'nullable|integer',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'layanan_id.exists' => 'layanan tidak ditemukan',
        ]);
        $validated['user_id'] = $request->user_id ?? auth()->user()->id;

        $create = Pesanan::create($validated);

        if ($create) {
            Transaksi::create([
                'pesanan_id' => $create->id,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->meode_pembayaran == 'tunai' ? 'pending' : 'belum bayar',
            ]);

            if (auth()->user()->peran == 'kasir') {
                return redirect(route('kasir.menu'))->with('success', 'Berhasil membuat pesanan');
            } else if (auth()->user()->peran == 'pelanggan') {
                return redirect(route('pelanggan.my'))->with('success', 'Berhasil membuat pesanan');
            }
        }

        return back()->with('error', 'Gagal membuat pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan): View
    {
        return view('pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan): RedirectResponse
    {
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanan,id',
            'nama_pelanggan' => 'required|string',
            'jadwal_pengambilan' => 'required',
            'jadwal_pengantaran' => 'required',
            'alamat' => 'required|string',
            'jumlah' => 'required|decimal:0,2',
            'harga' => 'required|integer',
            'total_biaya' => 'required|integer',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'layanan_id.exists' => 'layanan tidak ditemukan',
        ]);

        if ($pesanan->update($validated)) {
            if ($request->metode_pembayaran != $pesanan->transaksi->metode_pembayaran) {
                Transaksi::find($pesanan->transaksi->id)->update([
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'status' => $request->meode_pembayaran == 'tunai' ? 'pending' : 'belum bayar',
                ]);
            }
            if (auth()->user()->peran == 'kasir') {
                return redirect(route('kasir.menu'))->with('success', 'Berhasil mengubah data pesanan');
            } else if (auth()->user()->peran == 'pelanggan') {
                return redirect(route('pelanggan.my'))->with('success', 'Berhasil mengubah data pesanan');
            }
        }
        return back()->with('error', 'Gagal mengubah data pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        if ($pesanan->delete()) {
            return redirect(route('kasir.menu'))->with('success', 'Berhasil menghapus data pesanan');
        }
        return back()->with('error', 'Gagal menghapus data pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }

    public function payment(Request $request, Pesanan $pesanan): View
    {
        return view('pesanan.pembayaran', compact('pesanan'));
    }

    public function uploadProof(Request $request, Transaksi $transaksi): RedirectResponse
    {
        $validated = $request->validate([
            'bukti' => 'required|image|exclude'
        ]);

        if ($request->hasFile('bukti')) {
            $filename = $transaksi->pesanan_id . "-non-tunai.webp";
            $path = $request->file('bukti')->storeAs('bukti-pembayaran', $filename);

            $validated['bukti_path'] = $path;
            $validated['status'] = 'pending';
        }

        if ($transaksi->update($validated)) {
            return redirect(route('pelanggan.my'))->with('success', 'Berhasil melakukan pembayaran, silahkan tunggu kami mengambil cucian Anda sesuai jadwal');
        }

        return back()->with('error', 'Gagal mengunggah bukti. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }

    public function approveTransaksi(Transaksi $transaksi): RedirectResponse
    {
        if ($transaksi->update(['status' => 'dibayar'])) {
            return redirect(route('kasir.menu'))->with('success', 'Berhasil menyetujui pembayaran');
        }
        return back()->with('error', 'Gagal menyetujui pembayaran. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }

    public function cancelPesanan(Pesanan $pesanan): RedirectResponse
    {
        $transaksi = Transaksi::find($pesanan->transaksi->id);
        if ($pesanan->update(['status' => 'dibatalkan'])) {
            $transaksi->update(['status' => 'dibatalkan']);
            return redirect(route('kasir.menu'))->with('success', 'Berhasil membatalkan pesanan');
        }
        return back()->with('error', 'Gagal membatalkan pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }

    public function statusPesanan(Request $request, Pesanan $pesanan): RedirectResponse
    {
        if ($pesanan->update(['status' => $request->status])) {
            return redirect(route('kasir.menu'))->with('success', 'Berhasil mengubah status pesanan');
        }
        return back()->with('error', 'Gagal mengubah status pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }
}
