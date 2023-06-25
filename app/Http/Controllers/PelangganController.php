<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(): View
    {
        $list_layanan = Layanan::all();
        return view('menu.pelanggan', compact('list_layanan'));
    }
}
