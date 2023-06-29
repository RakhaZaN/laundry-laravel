<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(): View
    {
        $list_layanan = Layanan::all();
        return view('menu.pelanggan', compact('list_layanan'));
    }

    public function profil(): View
    {
        return view('user.profil');
    }

    public function myPesanan(): View
    {
        $list_pesanan = Pesanan::where('user_id', auth()->user()->id)->latest()->get();
        return view('pesanan.pelanggan', compact('list_pesanan'));
    }
}
