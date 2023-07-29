@extends('layouts.fullscreen')

@section('contents')
    <div class="d-flex align-items-center mb-30">
        <h1 class="display-4 font-weight-bold mr-3">Kelola Pesanan</h1>
        @if (count($list_pesanan) > 0)
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
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-30">
                <h3 class="font-weight-bold">Data Pesanan</h3>
                {{-- <a href="{{ route('kasir.pesanan.create') }}" class="genric-btn primary medium">Tambah Pesanan</a> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-stipped">
                    <thead>
                        <tr class="table-head">
                            <td scope="col" class="align-middle">Nama Pelanggan</td>
                            <td scope="col" class="align-middle">Layanan</td>
                            <td scope="col" class="align-middle">Jumlah</td>
                            <td scope="col" class="align-middle">Total</td>
                            <td scope="col" class="align-middle">Jadwal Pengambilan</td>
                            <td scope="col" class="align-middle">Jadwal Pengantaran</td>
                            <td scope="col" class="align-middle">Status Pesanan</td>
                            <td scope="col" class="align-middle">Status Pembayaran</td>
                            <td scope="col" width="200px" class="text-center align-middle">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list_pesanan as $pesanan)
                            <tr class="table-row">
                                <td>{{ $pesanan->nama_pelanggan ?? $pesanan->user->nama }}</td>
                                <td>{{ $pesanan->layanan->nama }}</td>
                                <td>{{ $pesanan->jumlah }}</td>
                                <td>Rp{{ number_format($pesanan->total_biaya) }}</td>
                                <td>{{ $pesanan->jadwal_pengambilan }}</td>
                                <td>{{ $pesanan->jadwal_pengantaran }}</td>
                                <td>{{ $pesanan->status }}</td>
                                <td>
                                    {{ $pesanan->transaksi->status }}
                                    @if ($pesanan->transaksi->status == 'pending')
                                        <a href="#" class="text-warning link"
                                            style="display: block; font-size: 0.9rem; text-decoration: underline;"
                                            role="button" data-toggle="modal"
                                            data-target="#buktiModal-{{ $pesanan->id }}">Bukti</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (!in_array($pesanan->status, ['selesai', 'dibatalkan']))
                                        <a href="#" class="genric-btn info small" role="button" data-toggle="modal"
                                            data-target="#updateStatusModal-{{ $pesanan->id }}">
                                            <i class="fas fa-tasks"></i>
                                        </a>
                                    @endif
                                    @if (!in_array($pesanan->status, ['diantar', 'selesai', 'dibatalkan']))
                                        <a href="{{ route('kasir.pesanan.edit', $pesanan->id) }}"
                                            class="genric-btn small warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if (!in_array($pesanan->transaksi->status, ['dibayar', 'dibatalkan']))
                                            <a href="#" class="genric-btn danger small" role="button"
                                                data-toggle="modal" data-target="#deleteConfirmModal-{{ $pesanan->id }}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    @endif
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
    <!-- Modal Generate Laporan -->
    <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <form action="{{ route('kasir.laporan.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generateModalLabel">Laporan Pesanan</h5>
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
                        <input type="hidden" name="kategori" id="kategori" value="pesanan">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Batal</button>
                        <button type="submit" class="genric-btn primary">Buat Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Update Status Pesanan -->
    @foreach ($list_pesanan as $pesanan)
        <div class="modal fade" id="updateStatusModal-{{ $pesanan->id }}" tabindex="-1"
            aria-labelledby="updateStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('kasir.pesanan.status', $pesanan->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="status" class="col-12 col-md-4">Status</label>
                                <div class="col-12 col-md-8">
                                    @php
                                        $status = ['menunggu penjemputan', 'dijemput', 'diproses', 'diantar'];
                                    @endphp
                                    <select name="status" id="status" class="form-select">
                                        <option @selected($pesanan->status == 'menunggu penjemputan') @disabled(in_array($pesanan->status, $status))>Menunggu
                                            Penjemputan</option>
                                        <option value="dijemput" @selected($pesanan->status == 'dijemput') @disabled(in_array($pesanan->status, array_slice($status, 1)))>
                                            Dijemput</option>
                                        <option value="diproses" @selected($pesanan->status == 'diproses') @disabled(in_array($pesanan->status, array_slice($status, 2)))>
                                            Diproses</option>
                                        <option value="diantar" @selected($pesanan->status == 'diantar') @disabled(in_array($pesanan->status, array_slice($status, 3)))>
                                            Diantar</option>
                                        <option value="selesai" @selected($pesanan->status == 'selesai')>Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="genric-btn btn-secondary border-0"
                                data-dismiss="modal">Tidak</button>
                            <button type="submit" class="genric-btn primary">Perbarui Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
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
                        Apakah Anda benar ingin membatalkan data pesanan {{ $pesanan->nama }}</span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0"
                            data-dismiss="modal">Tidak</button>
                        <form action="{{ route('kasir.pesanan.cancel', $pesanan->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="genric-btn danger">Ya, Batalkan Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Approvement -->
    @foreach ($list_pesanan as $pesanan)
        @if ($pesanan->transaksi->status == 'pending')
            <div class="modal fade" id="buktiModal-{{ $pesanan->id }}" tabindex="-1"
                aria-labelledby="buktiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran -
                                {{ ucfirst($pesanan->transaksi->metode_pembayaran) }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                @if ($pesanan->transaksi->metode_pembayaran == 'tunai')
                                    <h6 class="h1 font-weight-bold text-primary">Dibayar Rp{{ $pesanan->total_biaya }}
                                    </h6>
                                @else
                                    <img src="{{ $pesanan->transaksi->bukti_path }}" alt="bukti pembayaran"
                                        class="w-100">
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('kasir.pesanan.approve', $pesanan->transaksi->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="genric-btn success"><i class="fas fa-check"></i>
                                    Setejui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endpush
