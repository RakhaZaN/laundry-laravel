@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Kelola Pesanan</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-30">
                <h3 class="font-weight-bold">Data Pesanan</h3>
                <a href="{{ route('admin.pesanan.create') }}" class="genric-btn primary medium">Tambah Pesanan</a>
            </div>
            <div class="table-responsive">
                <table class="table table-stipped">
                    <thead>
                        <tr class="table-head">
                            <td scope="col" width="200px" class="text-center">Gambar</td>
                            <td scope="col">Nama Pesanan</td>
                            <td scope="col">Deskripsi</td>
                            <td scope="col">Kategori</td>
                            <td scope="col">Harga</td>
                            <td scope="col" width="200px" class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list_pesanan as $pesanan)
                            <tr class="table-row">
                                <td class="text-center">
                                    @if ($pesanan->gambar != null)
                                        <img src="{{ asset($pesanan->gambar) }}" alt="{{ $pesanan->nama }}"
                                            style="height: 100px; object-fit: cover; object-position: center">
                                    @else
                                    @endif
                                </td>
                                <td>{{ $pesanan->nama }}</td>
                                <td>{{ $pesanan->deskripsi }}</td>
                                <td>{{ $pesanan->kategori }}</td>
                                <td>Rp{{ $pesanan->harga }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}"
                                        class="genric-btn small warning"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="genric-btn danger small" role="button" data-toggle="modal"
                                        data-target="#deleteConfirmModal-{{ $pesanan->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada pesanan tersedia</td>
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
    @foreach ($list_pesanan as $pesanan)
        <div class="modal fade" id="deleteConfirmModal-{{ $pesanan->id }}" tabindex="-1"
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
                        Apakah Anda benar ingin menghapus data pesanan {{ $pesanan->nama }}</span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="post">
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
