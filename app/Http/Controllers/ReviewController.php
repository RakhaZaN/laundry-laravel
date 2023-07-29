<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reviews = Review::all();
        return view('review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'review' => 'required|string'
        ]);

        if (Review::create($validated)) {
            return redirect(route('review.index'));
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $review = Review::where('user_id', auth()->user()->id)->first();
        return view('review.form', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'review' => 'required|string'
        ]);

        if ($review->update($validated)) {
            return redirect(route('review.index'));
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(review $review): RedirectResponse
    {
        if ($review->delete()) {
            return redirect(route('review.index'));
        }

        return back();
    }

    public function createOrUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'review' => 'required|string',
        ]);

        $upsert = Review::updateOrInsert(['user_id' => auth()->user()->id], $validated);

        if ($upsert) {
            return redirect(route('pelanggan.review'))->with('success', 'Berhasil menyimpan review');
        }

        return back()->with('error', 'Gagal menyimpan review. Terjadi kesalahan, coba lagi dalam beberapa menit');
    }
}
