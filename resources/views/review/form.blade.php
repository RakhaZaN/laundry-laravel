@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Review</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <form action="{{ route('pelanggan.review.save') }}" method="post">
            @csrf
            <div class="card-body">
                <h3 class="mb-30 font-weight-bold">Form Review</h3>
                <div class="form-group">
                    <textarea name="review" id="review" placeholder="Tuliskan pendapat Anda disini . . ." class="single-textarea"
                        style="min-height: 30vh; height: 100%;">{{ old('review') ?? ($review->review ?? '') }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="genric-btn primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
