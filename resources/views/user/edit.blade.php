@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Ubah User</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <h3 class="mb-30 font-weight-bold">Form Data User</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama User</label>
                            <input type="text" name="nama" id="nama" class="single-input"
                                placeholder="Masukkan nama user" value="{{ old('nama') ?? $user->nama }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="tel" name="telepon" id="telepon" class="single-input"
                                placeholder="Masukkan telepon user" maxlength="15"
                                value="{{ old('telepon') ?? $user->telepon }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="single-input"
                                placeholder="Masukkan Email Anda" value="{{ old('email') ?? $user->email }}" readonly>
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
                                    <span class="current">{{ ucfirst($user->peran) }}</span>
                                    <ul class="list">
                                        <li data-value="pelanggan"
                                            class="option{{ $user->peran == 'pelanggan' ? ' selected focus' : '' }}">
                                            Pelanggan</li>
                                        <li data-value="kasir"
                                            class="option{{ $user->peran == 'kasir' ? ' selected focus' : '' }}">Kasir</li>
                                        <li data-value="admin"
                                            class="option{{ $user->peran == 'admin' ? ' selected focus' : '' }}">Admin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" class="single-input"
                                placeholder="Masukkan password jika ingin mengubah">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="genric-btn default">kembali</a>
                    <button type="submit" class="genric-btn primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
