@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-20">Ubah Layanan</h1>

    <div class="card">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <h3 class="mb-30 font-weight-bold">Form Data Layanan</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Layanan</label>
                            <input type="text" name="nama" id="nama" class="single-input"
                                placeholder="Masukkan nama layanan" value="{{ old('nama') ?? $layanan->nama }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="deslripsi">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="single-input"
                                placeholder="Masukkan deskripsi layanan"
                                value="{{ old('deskripsi') ?? $layanan->deskripsi }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Kategori</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="kategori" id="satuan_r" value="satuan" class="form-check-input"
                                    {{ $layanan->kategori == 'satuan' ? 'checked' : '' }}>
                                <label for="satuan_r">Satuan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="kategori" id="kiloan_r" value="kiloan" class="form-check-input"
                                    {{ $layanan->kategori == 'kiloan' ? 'checked' : '' }}>
                                <label for="kiloan_r">Kiloan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="single-input"
                                placeholder="Masukkan harga layanan" value="{{ old('harga') ?? $layanan->harga }}">
                        </div>
                    </div>
                    <div class="col-2">
                        <img src="{{ $layanan->gambar }}" alt="photo" style="width: 100%">
                    </div>
                    <div class="col-10 col-md-6">
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="single-input">
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
