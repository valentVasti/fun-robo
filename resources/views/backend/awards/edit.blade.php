@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Edit Awards</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form method="POST" action="{{ route('awards.update', ['id' => $awards->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="achievement">Achievement</label>
            <input id="achievement" name="achievement" value="{{ $awards->achievement }}">

            @error('achievement')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="event">Event</label>
            <input id="event" name="event" value="{{ $awards->event }}">

            @error('event')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="year">Year</label>
            <input id="year" name="year" value="{{ $awards->year }}">

            @error('year')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="place">Place</label>
            <input id="place" name="place" value="{{ $awards->place }}">

            @error('place')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="place">Type</label>
            <select name="type">
                <option disabled>Select Tag...</option>
                @if($awards->type == 'National')
                <option value="National" selected>National</option>
                <option value="International">International</option>
                @else
                <option value="National">National</option>
                <option value="International" selected>International</option>
                @endif
            </select>

            @error('type')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label>Image 1</label>
            <div class="file-container" data-index="1">
                <label for="image_1" class="upload-btn">Upload File</label>
                <span id="file-name-display-1" class="file-name-display">No image chosen</span>
            </div>
            <input type="file" id="image_1" name="image_1" onchange="displayFileName(this, 1)">
            <div class="preview-container">
                <div>
                    <p class="new-img-text">New Image</p>
                    <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">
                </div>
                <div>
                    <p class="ex-img-text">Existing Image</p>
                    <img class="preview-img" src="{{ asset('images/database/awards/'.$image_1->path) }}" alt="No image choosen">
                </div>
            </div>

            @error('image_1')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="image_desc_1">Image 1 Description</label>
            <input id="image_desc_1" name="image_desc_1" value="{{ $image_1->image_desc }}">

            @error('image_desc_1')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label>Image 2</label>
            <div class="file-container" data-index="2">
                <label for="image_2" class="upload-btn">Upload File</label>
                <span id="file-name-display-2" class="file-name-display">No image chosen</span>
            </div>
            <input type="file" id="image_2" name="image_2" onchange="displayFileName(this, 2)">
            <div class="preview-container">
                <div>
                    <p class="new-img-text">New Image</p>
                    <img id="previewImage2" class="preview-img" src="#" alt="No image choosen">
                </div>
                <div>
                    <p class="ex-img-text">Existing Image</p>
                    <img class="preview-img" src="{{ asset('images/database/awards/'.$image_2->path) }}" alt="No image choosen">
                </div>
            </div>

            @error('image_2')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="image_desc_2">Image 2 Description</label>
            <input id="image_desc_2" name="image_desc_2" value="{{ $image_2->image_desc }}">

            @error('image_desc_2')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="btn-group">
            <button type="submit" id="submit-btn">Submit</button>
            
        </div>
    </form>

</div>

@endsection

@section('activePage', 'awards')