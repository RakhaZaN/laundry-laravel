@extends('laporan.template.layout')

@section('kategori')
    User
@endsection

@section('waktu')
    {{ $waktu }}
@endsection

@section('isi')
    <table class="table table-stipped">
        <thead>
            <tr class="table-head">
                <td scope="col" rowspan="2" class="align-middle">Nama User</td>
                <td scope="col" rowspan="2" class="align-middle">Telepon</td>
                <td scope="col" rowspan="2" class="align-middle">Alamat</td>
                <td scope="col" colspan="5" class="text-center">Pesanan</td>
            </tr>
            <tr class="text-center">
                <td scope="col" class="border-top-0">Total</td>
                <td scope="col" class="border-top-0">Belum Bayar</td>
                <td scope="col" class="border-top-0">Pending</td>
                <td scope="col" class="border-top-0">Dibayar</td>
                <td scope="col" class="border-top-0">Dibatalkan</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $user)
                @php
                    $status_count = [0, 0, 0, 0];
                    foreach ($user->pesanan as $pesanan) {
                        switch ($pesanan->transaksi->status) {
                            case 'belum bayar':
                                $status_count[0] += 1;
                                break;
                            case 'pending':
                                $status_count[1] += 1;
                                break;
                            case 'dibayar':
                                $status_count[2] += 1;
                                break;
                            case 'dibatalkan':
                                $status_count[3] += 1;
                                break;
                        }
                    }
                @endphp
                <tr class="table-row">
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->telepon }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td class="text-center">{{ count($user->pesanan) }}</td>
                    <td class="text-center">{{ $status_count[0] }}</td>
                    <td class="text-center">{{ $status_count[1] }}</td>
                    <td class="text-center">{{ $status_count[2] }}</td>
                    <td class="text-center">{{ $status_count[3] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada user tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
