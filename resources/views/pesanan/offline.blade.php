@extends('layouts.fullscreen')


@section('contents')
    <div class="text-center mb-30">
        <h1 class="display-4 text-primary font-weight-bold">Nusantara Laundry</h1>
        <h2 class="h4">cepat, bersih, rapih, dan wangi</h2>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-1">
            <h3 class="font-weight-bold text-center">Laundry Kiloan</h3>
            <div class="row" style="row-gap: 1rem;">
                @forelse ($list_layanan as $layanan)
                    @if ($layanan->kategori == 'kiloan')
                        <div class="col-12 col-md-6">
                            <a href="{{ route('kasir.pesanan.create', ['layanan' => $layanan->id]) }}" class="card h-100">
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center text-center h-100">
                                        <img src="{{ $layanan->gambar }}" alt="gambar layanan {{ $layanan->nama }}"
                                            width="100" height="100" class="mb-3"
                                            style="object-fit: cover; object-position: center">
                                        <h4>{{ $layanan->nama }}</h4>
                                        <p class="text-secondary h6 mb-auto">{{ $layanan->deskripsi }}</p>
                                        <h6>Rp<span class="mt-auto h4 text-primary">{{ $layanan->harga }}</span>/kg
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @empty
                    <p>Belum ada layanan tersedia</p>
                @endforelse
            </div>
        </div>
        <div class="col-12 col-md-4">
            <h3 class="font-weight-bold text-center">Laundry Satuan</h3>
            <div class="row" style="row-gap: 1rem;">
                @forelse ($list_layanan as $layanan)
                    @if ($layanan->kategori == 'satuan')
                        <div class="col-12">
                            <a href="{{ route('kasir.pesanan.create', ['layanan' => $layanan->id]) }}"
                                class="card text=center">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="{{ $layanan->gambar }}" alt="gambar layanan {{ $layanan->nama }}"
                                            width="80" height="80" style="object-fit: cover; object-position: center"
                                            class="mr-3">
                                        <div>
                                            <h4>{{ $layanan->nama }}</h4>
                                            <p class="text-secondary h6">{{ $layanan->deskripsi }}</p>
                                            <h6>Rp<span class="h4 text-primary">{{ $layanan->harga }}</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @empty
                    <p>Belum ada layanan tersedia</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
