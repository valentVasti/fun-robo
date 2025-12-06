<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- CSS -->
    <link href="{{ mix('css/backend/login.css') }}" rel="stylesheet">

</head>

<body>
    <div class="login-card">
        <div class="card-header">
            <img src="{{ asset('images/logo/Logo_8.png') }}" />
            <h2>DATA MANAGEMENT</h2>
        </div>
        <div class="card-body">
            <form action="{{route('login.auth')}}" method="POST">
                @csrf
                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username') }}">
                </div>

                <div>
                    <label>Password</label>
                    <input type="password" name="password" value="{{ old('password') }}">
                </div>
                @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit">Login</button>
            </form>
        </div>

    </div>
</body>

</html>