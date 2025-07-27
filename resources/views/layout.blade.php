<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arcus</title>
    <link rel="stylesheet" href="{{ asset('universal/style.css') }}">
    <link rel="stylesheet" href="{{ asset('universal/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('chatting/style.css') }}">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    @if (session('success'))
        <div class="toast animate success">
            <div class="content">{{ session('success') }}</div>
            <i class='toast-close bxr bx-x'></i>
        </div>
    @endif
    @if (session('error'))
        <div class="toast animate danger">
            <div class="content">
                <i class='bxr bx-alert-triangle'></i>{{ session('error') }}
            </div>
            <i class='toast-close bxr bx-x'></i>
        </div>
    @endif
    <div class="main-container">
        <div class="chats container">
            <div class="header">
                <div class="title tx-neutral">
                    <h1>Arcus</h1>
                </div>
                <div class="options">
                    <i class='menu icon action tx-neutral bxr bx-menu'></i>
                    <div class="opt-container collapse">
                        <a href="{{ route('profile') }}"><i
                                class='icon action tx-neutral bx bx-user-square'></i>Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"><i
                                    class='icon action tx-neutral bx bx-arrow-out-up-square-half'></i>Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            @yield('search')
            @yield('filter')
            <div class="contacts">
                @yield('chat')
            </div>
            <div class="actions">
                <a href="{{ route('chat') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                    <i class='icon action bxr bx-message'></i>
                    Chat
                </a>
                <a href="{{ route('request') }}" class="{{ request()->is('request') ? 'active' : '' }}">
                    <i class='icon action bxr bx-message'></i>
                    Requests
                </a>
            </div>
        </div>
        <div class="messages container {{ request()->is('*/chat') ? 'active' : '' }}">
            @yield('messages')
        </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('universal/toast.js') }}"></script>
<script src="{{ asset('chatting/app.js') }}"></script>
@stack('js')


</html>
