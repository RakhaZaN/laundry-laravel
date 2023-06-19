@extends('layouts.fullscreen')

@section('contents')
    <div class="container">
        <div class="col-12 col-md-6 mx-auto">
            <h1 class="display-3 fw-bold text-primary text-center">Nusantara Laundry</h1>
            <p class="text-secondary text-center">Isi form dengan data Anda</p>

            <form action="{{ route('auth.register.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="mt-10">
                            <input type="text" name="name" id="name" class="single-input"
                                placeholder="Masukkan Nama Anda">
                        </div>
                        <div class="mt-10">
                            <input type="tel" name="phone" id="phone" class="single-input"
                                placeholder="Masukkan Nomor Telepon Anda" maxlength="15">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" id="email" class="single-input"
                                placeholder="Masukkan Email Anda">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password" id="password" class="single-input"
                                placeholder="Masukkan Password Anda">
                        </div>
                        <div class="mt-20 d-flex justify-content-end">
                            <button type="submit" class="genric-btn info ">Buat Akun</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
