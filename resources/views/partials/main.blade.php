<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arcus</title>
    <link rel="stylesheet" href="{{ asset('universal/style.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">
    <link rel="stylesheet" href="{{ asset('universal/toast.css') }}">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    @include('partials.header')
    @yield('content')
</body>
<script src="{{ asset('universal/toast.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('js')
{{-- <script src="{{ asset('universal/toast.js') }}"></script>
<script src="{{ asset('universal/checkUsername.js') }}"></script> --}}

</html>
