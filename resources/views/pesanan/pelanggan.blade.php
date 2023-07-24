@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Pesanan Saya</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-stipped">
                    <thead>
                        <tr class="table-head">
                            <td scope="col">Layanan</td>
                            <td scope="col">Jumlah</td>
                            <td scope="col">Harga</td>
                            <td scope="col">Total</td>
                            <td scope="col">Jadwal Pengambilan</td>
                            <td scope="col">Jadwal Pengantaran</td>
                            <td scope="col">Status</td>
                            <td scope="col" width="200px" class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list_pesanan as $pesanan)
                            <tr class="table-row">
                                <td>{{ $pesanan->layanan->nama }}</td>
                                <td>{{ $pesanan->jumlah }}</td>
                                <td>Rp{{ $pesanan->harga }}</td>
                                <td>{{ $pesanan->total_biaya }}</td>
                                <td>{{ $pesanan->jadwal_pengambilan }}</td>
                                <td>{{ $pesanan->jadwal_pengantaran }}</td>
                                <td>{{ $pesanan->transaksi->status }}</td>
                                <td class="text-center">
                                    @if ($pesanan->transaksi->status == 'belum bayar')
                                        <a href="{{ route('pelanggan.pembayaran', $pesanan->transaksi->id) }}"
                                            class="genric-btn small info"><i class="fas fa-shopping-bag"></i></a>
                                        <a href="{{ route('pelanggan.pesanan.edit', $pesanan->id) }}"
                                            class="genric-btn small warning"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="genric-btn danger small" role="button" data-toggle="modal"
                                            data-target="#deleteConfirmModal-{{ $pesanan->id }}">
                                            <i class="fas fa-times"></i>
                                        </a>
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
                        Apakah Anda benar ingin membatalkan pesanan {{ $pesanan->layanan->nama }} :
                        {{ $pesanan->jadwal_pengambilan }} - {{ $pesanan->jadwal_pengantaran }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn btn-secondary border-0" data-dismiss="modal">Tidak</button>
                        <form action="{{ route('pelanggan.pesanan.cancel', $pesanan->transaksi->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="genric-btn danger">Ya, Batalkan Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
