@extends('layouts.fullscreen')

@section('contents')
    <h1 class="display-4 font-weight-bold mb-30">Pesanan Baru</h1>

    <div class="card">
        <form ac tion="{{ route('pelanggan.pesanan.store') }}" method="post">
            <div class="card-body">

            </div>
        </form>
    </div>
@endsection
