{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('universal/style.css') }}">
    <link rel="stylesheet" href="{{ asset('universal/profile.css') }}">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        {{ Auth::user()->email }}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <div class="sub-container">
            <div class="picture">
                <label for="picture">Profile Picture</label>
                <img src="{{ asset('assets/maria.png') }}" alt="">
                <i class='icon action tx-highlight bxr bx-edit'></i>

            </div>
        </div>
        <div class="sub-container">
            <div class="form-control">
                <form action="{{ route('register') }}" method="POST" autocomplete="off">
                    @csrf
                    <label for="email">Email (Can't be Changed)</label>
                    <input type="text" id='email' placeholder="Email" name="email"
                        value="{{ Auth::user()->email }}" disabled>
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <input type="text" placeholder="@Username" name="username" id="username"
                            value="{{ Auth::user()->username }}">
                        <span id="username-status"></span>
                    </div>
                    <label for="bio">Bio</label>
                    <div class="input-wrapper">
                        <input type="text" placeholder="Bio" name="bio" id="bio"
                            value="{{ Auth::user()->bio }}">
                    </div>

                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" placeholder="Leave blank to keep current" name="password" id="password">
                        <i class='icon action tx-highlight bxr bx-eye'></i>
                    </div>
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" placeholder="Confirm Password" name="password_confirmation"
                            id="confirm_password">
                        <i class='icon action tx-highlight bxr bx-eye bx-bounce'></i>
                    </div>

                    <input type="submit" class="bg-highlight tx-neutral" value="Update Profile">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('universal/eye.js') }}"></script>
<script src="{{ asset('universal/checkUsername.js') }}"></script>

</html> --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('universal/style.css') }}">
    <link rel="stylesheet" href="{{ asset('universal/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('universal/toast.css') }}">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
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
    <div class="container">
        <div class="title">
            <div class="back-btn">
                <a href="{{ route('chat') }}">
                    <i class='icon action tx-highlight bxr bx-arrow-left-stroke'></i>
                </a>
            </div>
            <h1>Account</h1>
        </div>
        <div class="form-control">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="picture">
                    <div class="picture-container">
                        <img src="{{ asset('storage/' . Auth::user()->picture) }}" alt="User profile picture">
                    </div>
                    <div class="btn-container">

                        <label for="fileinput">Change Profile Picture <i class='bx bx-edit'
                                aria-label="Edit profile picture"></i></label>
                        <a href="{{ route('setdefaultPicture') }}">Set as Default</a>
                        <input type="file" name="picture" id="fileinput" accept="image/*">
                    </div>
                </div>
                <div class="field">
                    <div class="input-field">
                        <label for="email">Email (Can't be Changed)</label>
                        <input type="text" id='email' placeholder="Email" name="email"
                            value="{{ Auth::user()->email }}" disabled>
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="@Username" name="username" id="username"
                                value="{{ Auth::user()->username }}">
                            <span id="username-status"></span>
                        </div>
                        <label for="name">Name</label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="Name" name="name" id="name"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <label for="bio">Bio</label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="Bio" name="bio" id="bio"
                                value="{{ Auth::user()->bio }}">
                        </div>

                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" placeholder="Leave blank to keep current" name="password"
                                id="password">
                            <i class='icon action tx-highlight bxr bx-eye'></i>
                        </div>
                        <label for="confirm_password">Confirm Password</label>
                        <div class="input-wrapper">
                            <input type="password" placeholder="Confirm Password" name="password_confirmation"
                                id="confirm_password">
                            <i class='icon action tx-highlight bxr bx-eye bx-bounce'></i>
                        </div>
                        <input type="submit" class="bg-highlight tx-neutral" value="Update Profile">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('universal/eye.js') }}"></script>
<script src="{{ asset('universal/toast.js') }}"></script>
<script src="{{ asset('universal/previewImage.js') }}"></script>
<script src="{{ asset('universal/checkUsername.js') }}"></script>

</html>
