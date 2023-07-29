@extends('laporan.template.layout')

@section('kategori')
    Layanan
@endsection

@section('waktu')
    {{ $waktu }}
@endsection

@section('isi')
    <table class="table table-stripped">
        <thead>
            <tr class="table-head">
                <td scope="col" width="200px" class="text-center">Gambar</td>
                <td scope="col">Nama Layanan</td>
                <td scope="col">Deskripsi</td>
                <td scope="col">Kategori</td>
                <td scope="col">Harga</td>
                <td scope="col">Dipesan</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $layanan)
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
                    <td>{{ count($layanan->pesanan) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada layanan tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
