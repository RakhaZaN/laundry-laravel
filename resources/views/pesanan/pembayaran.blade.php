@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-30">Pembayaran</h1>

    @if (session('success'))
        <div class="alert alert-success mb-10">{{ session('success') }}</div>
    @endif
    <div class="row" style="row-gap: 1rem">
        <div class="col-12 col-md-6 order-md-last">
            <h3>Detail Pesanan</h3>
            <div class="d-flex justify-content-center">
                <img src="{{ $pesanan->layanan->gambar }}" alt="gambar layanan {{ $pesanan->layanan->nama }}" width="150"
                    height="150" class="my-3" style="object-fit: cover; object-position: center">
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p><b>{{ $pesanan->layanan->nama }}</b></p>
                <p>RP{{ $pesanan->harga }}</p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p>
                    <b>{{ $pesanan->layanan->kategori == 'satuan' ? 'Jumlah' : 'Berat' }}</b>
                </p>
                <p>{{ $pesanan->jumlah }}{{ $pesanan->layanan->kategori == 'satuan' ? '' : 'kg' }}</p>
            </div>
            <hr class="my-2">
            <div class="d-flex justify-content-between align-items-center">
                <p>
                    <b>Total Biaya</b>
                </p>
                <p>Rp{{ $pesanan->total_biaya }}</p>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <h3>Metode Pembayaran</h3>
            <div class="form-check form-check-inline">
                <input type="radio" name="metode" id="qris" class="form-check-input" value="qr">
                <label for="qris" class="form-check-label">QRIS</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="metode" id="tfBank" class="form-check-input" value="tf" checked>
                <label for="tfBank" class="form-check-label">Transfer Bank</label>
            </div>
            <div class="my-5">
                <div id="qr" class="method">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <p>Scan QR Code</p>
                        <img src="{{ asset('assets/img/icon/qr-code.png') }}" alt="qr code" width="150px">
                    </div>
                </div>
                <div id="tf" class="method">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <h5 class="font-weight-bold h1">0867110051</h5>
                        <h6>BNI A/N NUSANTARA LAUNDRY</h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('pelanggan.upload', ['transaksi' => $pesanan->transaksi->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="bukti">Bukti Pembayaran</label>
                    <input type="file" name="bukti" id="bukti" class="single-input">
                </div>
                <button class="genric-btn primary">Unggah</button>
            </form>
        </div>
    </div>
@endsection

@push('add-js')
    <script>
        $(document).ready(() => {
            const qrisRadio = $("#qris");
            const tfBankRadio = $("#tfBank");
            const qrDiv = $("#qr");
            const tfDiv = $("#tf");
            qrDiv.hide()

            qrisRadio.change(function() {
                qrDiv.show();
                tfDiv.hide();
            });

            tfBankRadio.change(function() {
                qrDiv.hide();
                tfDiv.show();
            });
        })
    </script>
@endpush
