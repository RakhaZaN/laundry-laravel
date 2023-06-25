@extends('layouts.fullscreen')

@section('contents')
    <div style="min-height: 80vh;" class="d-flex align-items-center justify-content-center">
        <div class="col-12 col-md-6 mx-auto">
            <h1 class="display-3 fw-bold text-primary text-center">Nusantara Laundry</h1>
            <p class="text-secondary text-center">Isi form dengan data Anda</p>

            <form action="{{ route('auth.register.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="mt-10">
                            <input type="text" name="nama" id="name" class="single-input"
                                placeholder="Masukkan Nama Anda" value="{{ old('nama') }}">
                        </div>
                        <div class="mt-10">
                            <input type="tel" name="telepon" id="telepon" class="single-input"
                                placeholder="Masukkan Nomor Telepon Anda" maxlength="15" value="{{ old('telepon') }}">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="alamat" id="alamat" class="single-input"
                                placeholder="Masukkan Alamat Anda" value="{{ old('alamat') }}">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" id="email" class="single-input"
                                placeholder="Masukkan Email Anda" value="{{ old('email') }}">
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
