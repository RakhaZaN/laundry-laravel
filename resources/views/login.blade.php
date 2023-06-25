@extends('layouts.fullscreen')

@section('contents')
    <div style="min-height: 80vh;" class="d-flex align-items-center justify-content-center">
        <div class="col-12 col-md-6 mx-auto">
            <h1 class="display-3 fw-bold text-primary text-center">Nusantara Laundry</h1>
            <p class="text-secondary text-center">Isi form dengan akun Anda</p>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('auth.login.authenticate') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="mt-10">
                            <input type="email" name="email" id="email" class="single-input"
                                placeholder="Masukkan Email Anda">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password" id="password" class="single-input"
                                placeholder="Masukkan Password Anda">
                        </div>
                        <div class="mt-20 d-flex justify-content-end">
                            <button type="submit" class="genric-btn info ">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
