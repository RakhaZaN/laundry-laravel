@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Kelola Layanan</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-30">
                <h3 class="font-weight-bold">Data Layanan</h3>
                <a href="{{ route('admin.layanan.create') }}" class="genric-btn primary medium">Tambah Layanan</a>
            </div>
            <div class="table-responsive">
                <table class="table table-stipped">
                    <thead>
                        <tr class="table-head">
                            <td scope="col" width="200px" class="text-center">Gambar</td>
                            <td scope="col">Nama Layanan</td>
                            <td scope="col">Deskripsi</td>
                            <td scope="col">Kategori</td>
                            <td scope="col">Harga</td>
                            <td scope="col" width="200px" class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list_layanan as $layanan)
                            <tr class="table-row">
                                <td class="text-center">
                                    @if ($layanan->gambar != null)
                                        <img src="{{ asset($layanan->gambar) }}" alt="{{ $layanan->nama }}"
                                            style="height: 100px; object-fit: cover; object-position: center">
                                    @else
                                    @endif
                                </td>
                                <td>{{ $layanan->nama }}</td>
                                <td>{{ $layanan->deskripsi }}</td>
                                <td>{{ $layanan->kategori }}</td>
                                <td>Rp{{ $layanan->harga }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.layanan.edit', $layanan->id) }}"
                                        class="genric-btn small warning"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="genric-btn danger small" role="button" data-toggle="modal"
                                        data-target="#deleteConfirmModal-{{ $layanan->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada layanan tersedia</td>
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
    @foreach ($list_layanan as $layanan)
        <div class="modal fade" id="deleteConfirmModal-{{ $layanan->id }}" tabindex="-1"
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
                        Apakah Anda benar ingin menghapus data layanan {{ $layanan->nama }}</span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="post">
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
