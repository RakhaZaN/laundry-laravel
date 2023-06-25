@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Kelola Laporan</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-30">
                <h3 class="font-weight-bold">Data Laporan</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-stipped">
                    <thead>
                        <tr class="table-head">
                            <td scope="col">File</td>
                            <td scope="col">Kategori</td>
                            <td scope="col">Dibuat oleh</td>
                            <td scope="col" width="200px" class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list_laporan as $laporan)
                            <tr class="table-row">
                                <td>{{ $laporan->nama }}</td>
                                <td>{{ $laporan->kategori }}</td>
                                <td class="text-center">
                                    <a href="#" class="genric-btn danger small" role="button" data-toggle="modal"
                                        data-target="#deleteConfirmModal-{{ $laporan->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada laporan tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('add-contents')
    <!-- Modal -->
    @foreach ($list_laporan as $laporan)
        <div class="modal fade" id="deleteConfirmModal-{{ $laporan->id }}" tabindex="-1"
            aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda benar ingin menghapus data laporan {{ $laporan->nama }}</span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="genric-btn danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
