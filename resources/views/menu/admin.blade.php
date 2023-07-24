@extends('layouts.fullscreen')

@push('add-css')
    <style>
        .custom {
            border: 1px solid #6884fc;
            background-color: white;
            color: #6884fc;
        }
    </style>
@endpush

@section('contents')
    <div style="min-height: 80vh;" class="d-flex flex-column align-items-center justify-content-center">
        <div class="row justify-content-center mb-5">
            <div class="col-6 col-md-5">
                <a href="{{ route('admin.users.index') }}"
                    class="custom rounded-circle text-center d-flex align-items-center justify-content-center w-100 p-3"
                    style="aspect-ratio: 1/1">Kelola Users</a>
            </div>
            <div class="col-6 col-md-5">
                <a href="{{ route('admin.layanan.index') }}"
                    class="custom rounded-circle text-center d-flex align-items-center justify-content-center w-100 p-3"
                    style="aspect-ratio: 1/1">Kelola Layanan</a>
            </div>
        </div>
        <div class="row justify-content-center" style="row-gap: 2rem">
            <div class="col-6 col-md-5">
                <a href="{{ route('admin.reviews.index') }}"
                    class="custom rounded-circle text-center d-flex align-items-center justify-content-center w-100 p-3"
                    style="aspect-ratio: 1/1">Kelola Reviews</a>
            </div>
            <div class="col-6 col-md-5">
                <a href="{{ route('admin.laporan.index') }}"
                    class="custom rounded-circle text-center d-flex align-items-center justify-content-center w-100 p-3"
                    style="aspect-ratio: 1/1">Kelola Laporan</a>
            </div>
        </div>
    </div>
@endsection
