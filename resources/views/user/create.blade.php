@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Tambah User</h1>

    <div class="card">
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="card-body">
                <h3 class="mb-30 font-weight-bold">Form Data User</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama User</label>
                            <input type="text" name="nama" id="nama" class="single-input"
                                placeholder="Masukkan nama user" value="{{ old('nama') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="tel" name="telepon" id="telepon" class="single-input"
                                placeholder="Masukkan telepon user" maxlength="15" value="{{ old('telepon') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="single-input"
                                placeholder="Masukkan Email Anda" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="peran">Peran</label>
                            <div class="form-select">
                                <select name="peran" id="peran" class="d-none">
                                    <option value="pelanggan">Pelanggan</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <div class="nice-select">
                                    <span class="current">Pelanggan</span>
                                    <ul class="list">
                                        <li data-value="pelanggan" class="option selected focus">Pelanggan</li>
                                        <li data-value="kasir" class="option">Kasir</li>
                                        <li data-value="admin" class="option">Admin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Password Bawaan</label>
                            <input type="text" name="password" id="password" class="single-input"
                                placeholder="Masukkan password" value="password123">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="genric-btn default">kembali</a>
                    <button type="submit" class="genric-btn primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
@endsection
