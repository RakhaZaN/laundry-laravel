@extends('layouts.fullscreen')

@section('contents')
    <div style="min-height: 80vh;" class="d-flex align-items-center justify-content-center">
        <div class="d-flex justify-content-center align-items-center" style="gap: 1rem;">
            <a href="{{ route('admin.users.index') }}" class="p-5 bg-primary rounded">Kelola Users</a>
            <a href="{{ route('admin.layanan.index') }}" class="p-5 bg-primary rounded">Kelola Layanan</a>
            <a href="{{ route('admin.reviews.index') }}" class="p-5 bg-primary rounded">Kelola Reviews</a>
            <a href="{{ route('admin.laporan.index') }}" class="p-5 bg-primary rounded">Kelola Laporan</a>
        </div>
    </div>
@endsection
