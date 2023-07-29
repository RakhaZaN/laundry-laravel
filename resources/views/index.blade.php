@extends('layouts.app')

@push('add-css')
    <style>
        .testimonials-area .testmonial-thumb span {
            transform: scale(0.4);
            transition: .6s;
            opacity: 0.4
        }

        .testimonials-area .testmonial-thumb.slick-current.slick-center span {
            transform: scale(0.6);
            opacity: 1;
            color: #6884fc;
        }

        .slick-slide span {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #6884fc;
            border-radius: 50%;
            aspect-ratio: 1/1;
            vertical-align: middle !important;
        }
    </style>
@endpush

@section('contents')
    <!--? slider Area Start-->
    <section class="slider-area hero-overly">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9 col-md-10 col-sm-9">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay="0.2s">Quality laundry service in your
                                    city</h1>
                                <p data-animation="fadeInLeft" data-delay="0.4s">We take care about cleenness of
                                    your cloth</p>
                                <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Explore
                                    Services</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider Area End-->
    <!--? Services Area Start -->
    <section class="services-area pt-top border-bottom pb-20 mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <span class="element">Our Process</span>
                        <h2>This is how we work</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services-icon1.svg') }}" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">We collect your clothes</a></h5>
                            <p>The automated process starts as soon as your clothes go into the machine. The outcome
                                is gleaming clothes!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services-icon2.svg') }}" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Wash your clothes</a></h5>
                            <p>The automated process starts as soon as your clothes go into the machine. The outcome
                                is gleaming clothes!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services-icon3.svg') }}" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Get delivery</a></h5>
                            <p>The automated process starts as soon as your clothes go into the machine. The outcome
                                is gleaming clothes!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->
    <!--? Offer-services Start  -->
    <section class="offer-services pb-bottom2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <span class="element">Services</span>
                        <h2>Services we offer</h2>
                    </div>
                </div>
            </div>
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
                                            <h5><a href="#" role="button">{{ $layanan->nama }}</a></h5>
                                            <p>{{ $layanan->deskripsi }}</p>
                                        </div>
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
                                            <h5><a href="#" role="button">{{ $layanan->nama }}</a></h5>
                                            <p>{{ $layanan->deskripsi }}</p>
                                        </div>
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
                                            <h5><a href="#" role="button">{{ $layanan->nama }}</a></h5>
                                            <p>{{ $layanan->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6 col-md-6">
                                <div class="single-offers">
                                    <img src="{{ asset('assets/img/gallery/offers2.png') }}" alt=""
                                        class=" w-100">
                                    <div class="offers-caption text-center" style="padding: 0 120px;">
                                        <div class="cat-icon">
                                            <img src="{{ asset('assets/img/icon/offers-icon1.png') }}" alt="">
                                        </div>
                                        <div class="cat-cap">
                                            <h5><a href="#" role="button">{{ $layanan->nama }}</a></h5>
                                            <p>{{ $layanan->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="single-offers">
                                    <img src="{{ asset('assets/img/gallery/offers4.png') }}" alt=""
                                        class=" w-100">
                                </div>
                            </div>
                        @endif
                    @endif
                @empty
                    <p class="text-center">Belum ada layanan tersedia</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Offer-services End  -->
    <!--? Want To work -->
    <section class="container">
        <section class="wantToWork-area" data-background="{{ asset('assets/img/gallery/section_bg01.png') }}">
            <div class="wants-wrapper w-padding2">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-8 col-lg-9 col-md-7">
                        <div class="wantToWork-caption wantToWork-caption2">
                            <h2>Call us for a service</h2>
                            <p>We deliver the goods to the most complicated places on earth</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5">
                        <a href="#" class="btn wantToWork-btn"><img src="{{ asset('assets/img/icon/call2.png') }}"
                                alt="">
                            Learn More</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Want To work End -->
    <!--? Testimonials_start -->
    <section class="testimonials-area testimonials-overly position-relative">
        <div class="container">
            <div class="border-bottom section-padding40">
                <div class="row">
                    <div class="col-xl-12 ">
                        <!-- testmonial-image -->
                        <div class="testmonial-nav text-center">
                            @foreach ($reviews as $key => $review)
                                <div class="testmonial-thumb">
                                    <span>{{ $key + 1 }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="testmonial-item-active text-center">
                            @forelse ($reviews as $review)
                                <!-- testimonial-single-items -->
                                <div class="testmonial-item ">
                                    <p class="pera px-5">{{ $review->review }}</p>
                                    {{-- <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                    <p> - {{ $review->user->nama }}</p>
                                </div>
                            @empty
                                <div class="testimonial-item ">
                                    <p class="pera">Belum ada review tersedia</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials_end -->
    <!--? About Area  -->
    <section class="about-area2 pb-bottom mt-30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <!-- about-img -->
                    <div class="about-img ">
                        <img src="{{ asset('assets/img/gallery/about1.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-25">
                            <h2>About company</h2>
                        </div>
                        <p class="mb-20">
                            The automated process starts as soon as your clothes go into the machine. The outcome is
                            gleaming clothes!
                        </p>
                        <p class="mb-30">The automated process starts as soon as your clothes go into the machine.
                            The outcome is gleaming clothes!</p>

                        <a href="about.html" class="btn">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
@endsection
