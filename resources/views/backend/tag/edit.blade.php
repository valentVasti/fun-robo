@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Edit Tag</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('tag.update', ['id' => $tag->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="tag_name">tag_name</label>
            <input id="tag_name" name="tag_name" value="{{ $tag->tag_name }}" />

            @error('tag_name')
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

@section('activePage', 'tag')