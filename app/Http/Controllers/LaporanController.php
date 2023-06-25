<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(): View
    {
        $list_laporan = Laporan::all();
        return view('laporan.index', compact('list_laporan'));
    }
}
