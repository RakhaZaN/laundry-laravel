<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $list_layanan = Layanan::all();
        return view('layanan.index', compact('list_layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|unique:layanan,nama',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:satuan,kiloan',
            'gambar' => 'nullable|image|max:1999|exclude'
        ], [
            'required' => ':attribute tidak boleh kosong!',
            'nama.unique' => 'nama layanan yang Anda masukkan sudah tersedia!',
            'in' => ':attribute harus bernilai :values',
            'gambar.max' => 'Size gambar maksimal adalah 2mb'
        ]);

        if ($request->hasFile('gambar')) {
            $filename = trim($request->nama) . ".webp";
            $path = $request->file('gambar')->storeAs('layanan', $filename);

            $validated['gambar'] = $path;
        }

        if (Layanan::create($validated)) {
            return redirect(route('admin.layanan.index'))->with('success', 'Berhasil membuat layanan baru');
        }
        return back()->with('error', 'Gagal membuat layanan baru. Terjadi kesalahan, coba lagi beberapa saat')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan): View
    {
        return view('layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:satuan,kiloan',
            'gambar' => 'nullable|image|max:1999|exclude'
        ], [
            'required' => ':attribute tidak boleh kosong!',
            'in' => ':attribute harus bernilai :values',
            'gambar.max' => 'Size gambar maksimal adalah 2mb'
        ]);

        if ($request->hasFile('gambar')) {
            $filename = trim($layanan->gambar) == '' ? trim($request->nama) . ".webp" : trim($layanan->nama) . ".webp";
            $path = $request->file('gambar')->storeAs('layanan', $filename);

            $validated['gambar'] = $path;
        }

        if ($layanan->update($validated)) {
            return redirect(route('admin.layanan.index'))->with('success', 'Berhasil mengubah data layanan');
        }
        return back()->with('error', 'Gagal mengubah data layanan. Terjadi Kesalahan, coba lagi beberapa saat')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan): RedirectResponse
    {
        if ($layanan->delete()) {
            return redirect(route('admin.layanan.index'))->with('success', 'Berhasil menghapus data layanan');
        }
        return back()->with('error', 'Gagal menghapus data layanan. Terjadi kesalahan, coba lagi beberapa saat');
    }
}
