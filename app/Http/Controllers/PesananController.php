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
            'jadwal_pengambilan' => 'required',
            'jadwal_pengantaran' => 'required',
            'alamat' => 'required|string',
            'jumlah' => 'required',
            'harga' => 'required|integer',
            'total_biaya' => 'required|integer',
        ]);
        $validated['user_id'] = $request->user_id ?? auth()->user()->id;

        $create = Pesanan::create($validated);

        if ($create) {
            Transaksi::create([
                'pesanan_id' => $create->id,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->metode_pembayaran == 'tunai' ? 'pending' : 'belum bayar',
            ]);

            if (auth()->user()->peran == 'kasir') {
                return redirect(route('kasir.pesanan.index'))->with('success', 'Berhasil membuat pesanan');
            } else if (auth()->user()->peran == 'pelanggan') {
                if ($request->mrtode_pembayaran == 'tunai') {
                    return redirect(route('pelanggan.menu'))->with('success', 'Berhasil membuat pesanan');
                } else {
                    return redirect(route('pelanggan.pembayaran', ['pesanan' => $create->id]))->with('success', 'Berhasil membuat pesanan. Silahkan melakukan pembayaran');
                }
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
            'jadwal_pengambilan' => 'required',
            'jadwal_pengantaran' => 'required',
            'alamat' => 'required|string',
            'jumlah' => 'required',
            'harga' => 'required|integer',
            'total_biaya' => 'required|integer',
        ]);

        if ($pesanan->update($validated)) {
            if ($request->metode_pembayaran != $pesanan->transaksi->metode_pembayaran) {
                Transaksi::find($pesanan->transaksi->id)->update([
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'status' => $request->metode_pembayaran != 'tunai' ? 'pending' : 'belum bayar',
                ]);
            }
            if ($request->metode_pembayaran == 'tunai') return redirect(route('pelanggan.my'))->with('success', 'Berhasil mengubah data pesanan');
            else return redirect(route('pelanggan.pembayaran', $pesanan->id))->with('success', 'Berhasil mengubah metode pembayaran menjadi Non-Tunai. Silahkan lanjutkan tahap pembayaran');
        }
        return back()->with('error', 'Gagal mengubah data pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        if ($pesanan->delete()) {
            return redirect(route('kasir.pesanan.index'))->with('success', 'Berhasil menghapus data pesanan');
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
            return redirect(route('pelanggan.menu'))->with('success', 'Berhasil melakukan pembayaran, silahkan tunggu kami mengambil cucian Anda sesuai jadwal');
        }

        return back()->with('error', 'Gagal mengunggah bukti. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }

    public function approveTransaksi(Transaksi $transaksi): RedirectResponse
    {
        if ($transaksi->update(['status' => 'dibayar'])) {
            return redirect(route('kasir.pesanan.index'))->with('success', 'Berhasil menyetujui pembayaran');
        }
        return back()->with('error', 'Gagal menyetujui pembayaran. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }

    public function cancelPesanan(Transaksi $transaksi): RedirectResponse
    {
        if ($transaksi->update(['status' => 'dibatalkan'])) {
            return redirect(route('kasir.pesanan.index'))->with('success', 'Berhasil membatalkan pesanan');
        }
        return back()->with('error', 'Gagal membatalkan pesanan. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }
}
