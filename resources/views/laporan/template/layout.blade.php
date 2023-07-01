<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body,
        span {
            font-size: 0.8rem;
            font-weight: 400;
        }

        table td {
            font-size: 0.9rem;
        }
    </style>

    <title>Laporan @yield('kategori')</title>
</head>

<body>
    @include('laporan.template.cop')
    <h1 class="h3 mt-30">Laporan @yield('kategori') <span>@yield('waktu')</span></h1>
    @yield('isi')
</body>

</html>
