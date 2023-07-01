@extends('laporan.template.layout')
@section('kategori')
    Pesanan
@endsection

@section('waktu')
    {{ $waktu }}
@endsection

@section('isi')
    <table class="table table-stripped">
        <thead>
            <tr class="table-head">
                <td scope="col">Tanggal</td>
                <td scope="col">Nama Pelanggan</td>
                <td scope="col">Nama Layanan</td>
                <td scope="col">Kategori</td>
                <td scope="col">Harga</td>
                <td scope="col">Jumlah</td>
                <td scope="col">Metode Pembayaran</td>
                <td scope="col">Status Pembayaran</td>
                <td scope="col" class="text-right">Total Biaya</td>
            </tr>
        </thead>
        <tbody>
            @php
                $sum = 0;
            @endphp
            @forelse ($list as $pesanan)
                @php
                    $sum = $pesanan->transaksi->status == 'dibayar' ? $sum + $pesanan->total_biaya : $sum;
                @endphp
                <tr class="table-row {{ $pesanan->transaksi->status == 'dibayar' ? 'bg-light' : '' }}">
                    <td>{{ $pesanan->created_at }}</td>
                    <td>{{ $pesanan->user->nama }}</td>
                    <td>{{ $pesanan->layanan->nama }}</td>
                    <td>{{ $pesanan->layanan->kategori }}</td>
                    <td>Rp{{ number_format($pesanan->harga) }}</td>
                    <td>
                        {{ $pesanan->jumlah }} {{ $pesanan->layanan->kategori == 'kiloan' ? 'kg' : 'pcs' }}
                    </td>
                    <td>{{ $pesanan->transaksi->metode_pembayaran }}</td>
                    <td>{{ $pesanan->transaksi->status }}</td>
                    <td class="text-right">Rp{{ number_format($pesanan->total_biaya) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada pesanan tersedia</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right font-weight-bold">Total Pemasukan</td>
                <td colspan="3" class="text-right text-success h5 font-weight-bold">Rp{{ number_format($sum) }}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
