<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(): View
    {
        $list_laporan = Laporan::latest()->get();
        return view('laporan.index', compact('list_laporan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|in:user,layanan,pesanan',
            'bulan' => 'required'
        ]);
        $tahun = now()->year;

        switch ($request->kategori) {
            case 'user':
                $list = User::with([
                    'pesanan' => function ($query) use ($request, $tahun) {
                        $query->select('id', 'user_id', 'alamat', 'created_at')->whereMonth('created_at', $request->bulan)->whereYear('created_at', $tahun);
                    },
                    'pesanan.transaksi:id,pesanan_id,metode_pembayaran,status'
                ])
                    ->where('peran', 'pelanggan')
                    ->get();
                break;
            case 'layanan':
                $list = Layanan::with([
                    'pesanan' => function ($query) use ($request, $tahun) {
                        $query->select('id', 'layanan_id')->whereMonth('created_at', $request->bulan)->whereYear('created_at', $tahun);
                    },
                ])
                    ->get();
                break;
            case 'pesanan':
                $list = Pesanan::with('transaksi:id,pesanan_id,metode_pembayaran,status')
                    ->whereMonth('created_at', $request->bulan)
                    ->whereYear('created_at', $tahun)
                    ->get();
                break;
        }
        // dd($list);
        $waktu = date('F', mktime(0, 0, 0, $request->bulan)) . ' - ' . $tahun;
        // return view('laporan.' . $request->kategori, compact('list', 'waktu'));
        $data = [
            'list' => $list,
            'waktu' => $waktu,
        ];

        $pdf = PDF::loadView('laporan.' . $request->kategori, $data);
        $pdfFile = $pdf->stream()->getOriginalContent();
        $filename = time() . '-' . $request->kategori . '-' . date('F', mktime(0, 0, 0, $request->bulan)) . '-' . $tahun . '.pdf';
        $path = 'laporan/pesanan/' . $filename;
        Storage::put($path, $pdfFile);

        $create = Laporan::create([
            'file_path' => $path,
            'kategori' => $request->kategori,
            'user_id' => auth()->user()->id,
        ]);
        if ($create) {
            if (auth()->user()->peran == 'kasir') {
                return redirect(route('kasir.pesanan.index'))->with('success', 'Berhasil membuat laporan ' . $request->kategori);
            }
            return redirect(route('admin.laporan.index'))->with('success', 'Berhasil membuat laporan ' . $request->kategori);
        }
        return back()->with('error', 'Gagal membuat laporan ' . $request->kategori);
    }

    public function destroy(Laporan $laporan): RedirectResponse
    {
        if ($laporan->delete()) {
            Storage::delete($laporan->file_path);
            return redirect(route('admin.laporan.index'))->with('success', 'Berhasil menghapus laporan');
        }
        return back()->with('error', 'Gagal menghapus laporan');
    }
}
