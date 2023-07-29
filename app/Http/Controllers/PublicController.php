<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        $list_layanan = Layanan::all();
        // return $reviews;
        // die;
        return view('index', compact('reviews', 'list_layanan'));
    }

    public function about(): View
    {
        $reviews = Review::all();
        return view('about', compact('reviews'));
    }
    public function services(): View
    {
        $reviews = Review::all();
        $list_layanan = Layanan::all();
        return view('services', compact('reviews', 'list_layanan'));
    }
}
