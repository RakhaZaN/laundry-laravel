@extends('layouts.fullscreen')


@section('contents')
    <div class="text-center mb-30">
        <h1 class="display-4 text-primary font-weight-bold">Nusantara Laundry</h1>
        <h2 class="h4">cepat, bersih, rapih, dan wangi</h2>
    </div>
    <section class="offer-services pb-bottom2">
        <div class="row no-gutters mb-55">
            <div class="col-12 text-center mb-10">
                <h3>Laundry Kiloan</h3>
            </div>
            @forelse ($list_layanan as $key => $layanan)
                @if ($layanan->kategori == 'kiloan')
                    @if (($key + 1) % 2 != 0)
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers1.png') }}" alt="" class=" w-100">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers2.png') }}" alt="" class=" w-100">
                                <div class="offers-caption text-center">
                                    <div class="cat-icon">
                                        <img src="{{ asset('assets/img/icon/offers-icon1.png') }}" alt="">
                                    </div>
                                    <div class="cat-cap">
                                        <h5><a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                                class="stretched-link">{{ $layanan->nama }}</a>
                                        </h5>
                                        <p>{{ $layanan->deskripsi }}</p>
                                    </div>
                                    <a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                        class="genric-btn default circle">Pilih Layanan</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers2.png') }}" alt="" class=" w-100">
                                <div class="offers-caption text-center">
                                    <div class="cat-icon">
                                        <img src="{{ asset('assets/img/icon/offers-icon1.png') }}" alt="">
                                    </div>
                                    <div class="cat-cap">
                                        <h5><a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                                class="stretched-link">{{ $layanan->nama }}</a>
                                        </h5>
                                        <p>{{ $layanan->deskripsi }}</p>
                                    </div>
                                    <a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                        class="genric-btn default circle">Pilih Layanan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers4.png') }}" alt="" class=" w-100">
                            </div>
                        </div>
                    @endif
                @endif
            @empty
                <p class="text-center">Belum ada layanan tersedia</p>
            @endforelse
        </div>
        <div class="row no-gutters">
            <div class="col-12 text-center mb-10">
                <h3>Laundry Satuan</h3>
            </div>
            @forelse ($list_layanan as $key => $layanan)
                @if ($layanan->kategori == 'satuan')
                    @if (($key + 1) % 2 != 0)
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers1.png') }}" alt="" class=" w-100">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers2.png') }}" alt="" class=" w-100">
                                <div class="offers-caption text-center" style="padding: 0 120px;">
                                    <div class="cat-icon">
                                        <img src="{{ asset('assets/img/icon/offers-icon1.png') }}" alt="">
                                    </div>
                                    <div class="cat-cap">
                                        <h5><a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                                class="stretched-link">{{ $layanan->nama }}</a>
                                        </h5>
                                        <p>{{ $layanan->deskripsi }}</p>
                                    </div>
                                    <a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                        class="genric-btn default circle">Pilih Layanan</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers2.png') }}" alt="" class=" w-100">
                                <div class="offers-caption text-center" style="padding: 0 120px;">
                                    <div class="cat-icon">
                                        <img src="{{ asset('assets/img/icon/offers-icon1.png') }}" alt="">
                                    </div>
                                    <div class="cat-cap">
                                        <h5><a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                                class="stretched-link">{{ $layanan->nama }}</a>
                                        </h5>
                                        <p>{{ $layanan->deskripsi }}</p>
                                    </div>
                                    <a href="{{ route('pelanggan.pesanan.create', ['layanan' => $layanan->id]) }}"
                                        class="genric-btn default circle">Pilih Layanan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-offers">
                                <img src="{{ asset('assets/img/gallery/offers4.png') }}" alt="" class=" w-100">
                            </div>
                        </div>
                    @endif
                @endif
            @empty
                <p class="text-center">Belum ada layanan tersedia</p>
            @endforelse
        </div>
    </section>
@endsection
