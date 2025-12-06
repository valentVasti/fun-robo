@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Create User</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div>
            <label for="username">Username</label>
            <input id="username" name="username" value="{{ old('username') }}">

            @error('username')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" name="password" value="{{ old('password') }}">

            @error('password')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="btn-group">
            <button id="submit-btn">Submit</button>
            
        </div>
    </form>
</div>

@endsection

@section('activePage', 'article')