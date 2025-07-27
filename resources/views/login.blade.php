@extends('partials.main')
@section('content')
    @if (session('success'))
        <div class="toast animate success">
            <div class="content">{{ session('success') }}</div>
            <i class='toast-close bxr bx-x'></i>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast animate danger">
            <div class="content">
                <i class='bxr bx-alert-triangle'></i>{{ $errors->first() }}
            </div>
            <i class='toast-close bxr bx-x'></i>
        </div>
    @endif
    <div class="container login-register">
        <h1 class="tx-neutral">Login</h1>
        <div class="form-control">
            <form action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <input type="text" placeholder="Email or Username" name="login" value="{{ old('login') }}">
                <div class="input-wrapper">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <i class='icon action tx-highlight bxr bx-eye'></i>
                </div>
                <input type="submit" class="bg-highlight tx-neutral" value="Login">
            </form>
            <div class="info">
                <a href="{{ route('registerPage') }}">
                    <p class="tx-highlight">Don't have an Account ?</p>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('universal/eye.js') }}"></script>
    <script src="{{ asset('universal/checkUsername.js') }}"></script>
@endpush
