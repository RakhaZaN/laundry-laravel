@extends('layouts.fullscreen')

@section('contents')
    <div class="d-flex align-items-center mb-30">
        <h1 class="display-4 font-weight-bold mr-3">Kelola Layanan</h1>
        @if (count($list_layanan) > 0)
            <a href="#" role="button" class="genric-btn success small" data-toggle="modal" data-target="#generateModal">
                <i class="fas fa-file-pdf"></i> Buat Laporan
            </a>
        @endif
    </div>

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
    <!-- Modal Generate Laporan -->
    <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <form action="{{ route('admin.laporan.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generateModalLabel">Laporan Layanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <div class="form-select">
                                @php
                                    $bulan_sekarang = now()->month;
                                @endphp
                                <select name="bulan" id="bulan" class="d-none">
                                    @for ($i = 1; $i <= $bulan_sekarang; $i++)
                                        @php
                                            $bulan = date('F', mktime(0, 0, 0, $i, 1));
                                        @endphp
                                        <option value="{{ $i }}">{{ $bulan }}</option>
                                    @endfor
                                </select>
                                <div class="nice-select float-none">
                                    <span class="current">-- Pilih Bulan --</span>
                                    <ul class="list">
                                        @for ($i = 1; $i <= $bulan_sekarang; $i++)
                                            @php
                                                $bulan = date('F', mktime(0, 0, 0, $i, 1));
                                            @endphp
                                            <li data-value="{{ $i }}"
                                                class="option {{ $i == $bulan_sekarang ? 'selected focus' : '' }}">
                                                {{ $bulan }}</li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="kategori" id="kategori" value="layanan">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Batal</button>
                        <button type="submit" class="genric-btn primary">Buat Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
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
                        <button type="button" class="genric-btn btn-secondary border-0"
                            data-dismiss="modal">Batal</button>
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
