@extends('partials.main')
@section('content')
    @if (session('success'))
        <div class="toast animate success">
            <div class="content">{{ session('success') }}</div>
            <span class="material-icons toast-close">clear</span>
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
        <h1 class="tx-neutral">Register</h1>
        <div class="form-control">
            <form action="{{ route('register') }}" method="POST" autocomplete="off">
                @csrf
                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
                <div class="input-wrapper">
                    <input type="text" placeholder="@Username" name="username" id="username"
                    value="{{ old('username') }}">
                    <span id="username-status"></span>
                </div>
                
                <input type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                <div class="input-wrapper">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <i class='icon action tx-highlight bxr bx-eye'></i>
                </div>
                <div class="input-wrapper">
                    <input type="password" placeholder="Confirm Password" name="password_confirmation"
                        id="confirm_password">
                    <i class='icon action tx-highlight bxr bx-eye bx-bounce'></i>
                </div>

                <input type="submit" class="bg-highlight tx-neutral" value="Register">
            </form>
            <div class="info">
                <a href="{{ route('loginPage') }}">
                    <p class="tx-highlight">Already have an Account ?</p>
                </a>
            </div>
        </div>
    </div>
    @push('js')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('universal/eye.js') }}"></script>
        <script src="{{ asset('universal/checkUsername.js') }}"></script>
    @endpush
@endsection
