<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
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
        $list_pesanan = Pesanan::all();
        return view('menu.kasir', compact('list_pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $layanan = Layanan::find($request->layanan);
        return view('pesanan.create', compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'layanan_id' => 'required|exists:layanan,id',
            'total' => 'required|integer',
        ]);

        $create = Pesanan::create($validated);

        if ($create) {
            if (auth()->user()->role == 'kasir')
                return redirect(route('kasir.pesanan.index'))->with('success', 'Berhasil membuat pesanan');
            else
                return redirect(url('/'))->with('success', 'Berhasil membuat pesanan');
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
            'user_id' => 'required|exists:users,id',
            'layanan_id' => 'required|exists:layanan,id',
            'total' => 'required|integer',
        ]);

        if ($pesanan->update($validated)) {
            return redirect(route('kasir.pesanan.index'));
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
}
