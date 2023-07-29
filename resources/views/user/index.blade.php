@extends('layouts.fullscreen')

@section('contents')
    <div class="d-flex align-items-center mb-30">
        <h1 class="display-4 font-weight-bold mr-3">Kelola User</h1>
        @if (count($users) > 0)
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
                <h3 class="font-weight-bold">Data User</h3>
                <a href="{{ route('admin.users.create') }}" class="genric-btn primary medium">Tambah User</a>
            </div>
            <div class="table-responsive">
                <table class="table table-stipped">
                    <thead>
                        <tr class="table-head">
                            <td scope="col">Nama User</td>
                            <td scope="col">Telepon</td>
                            <td scope="col">Alamat</td>
                            <td scope="col">Email</td>
                            <td scope="col">Peran</td>
                            <td scope="col" width="200px" class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="table-row">
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->telepon }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->peran }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="genric-btn small warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="genric-btn danger small" role="button" data-toggle="modal"
                                        data-target="#deleteConfirmModal-{{ $user->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada user tersedia</td>
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
                        <h5 class="modal-title" id="generateModalLabel">Laporan User</h5>
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
                        <input type="hidden" name="kategori" id="kategori" value="user">
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
    @foreach ($users as $user)
        <div class="modal fade" id="deleteConfirmModal-{{ $user->id }}" tabindex="-1"
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
                        Apakah Anda benar ingin menghapus data user {{ $user->nama }}</span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
