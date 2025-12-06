@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Create FAQ</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('faq.store') }}" method="post">
        @csrf
        <div>
            <label for="question">Question</label>
            <textarea id="question" name="question" class="editor">{{ old('question') }}</textarea>

            @error('question')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="answer">Answer</label>
            <textarea id="answer" name="answer" class="editor" rows="5">{{ old('answer') }}</textarea>

            @error('answer')
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

@section('activePage', 'faq')