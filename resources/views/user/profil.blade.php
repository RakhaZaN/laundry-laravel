@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Profil</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <form action="{{ route('pelanggan.profil.update', auth()->user()->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <h3 class="mb-30 font-weight-bold">Data Saya</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="single-input"
                                placeholder="Masukkan nama user" value="{{ old('nama') ?? auth()->user()->nama }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="tel" name="telepon" id="telepon" class="single-input"
                                placeholder="Masukkan telepon user" maxlength="15"
                                value="{{ old('telepon') ?? auth()->user()->telepon }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="single-input"
                                placeholder="Masukkan Email Anda" value="{{ old('email') ?? auth()->user()->email }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="single-input"
                                value="{{ old('alamat') ?? auth()->user()->alamat }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" class="single-input"
                                placeholder="Masukkan password jika ingin mengubah">
                        </div>
                    </div>
                    <input type="hidden" name="peran" id="peran" value="pelanggan">
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="genric-btn primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
