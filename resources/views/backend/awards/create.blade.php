@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Create Awards</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('awards.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="achievement">Achievement</label>
            <input id="achievement" name="achievement" value="{{ old('achievement') }}">

            @error('achievement')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="event">Event</label>
            <input id="event" name="event" value="{{ old('event') }}">

            @error('event')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="year">Year</label>
            <input id="year" name="year" type="number" value="{{ old('year') }}">

            @error('year')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="place">Place</label>
            <input id="place" name="place" value="{{ old('place') }}">

            @error('place')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="place">Type</label>
            <select name="type">
                <option disabled selected>Select Tag...</option>
                <option value="National">National</option>
                <option value="International">International</option>
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
            <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">

            @error('image_1')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="image_desc_1">Image 1 Description</label>
            <input id="image_desc_1" name="image_desc_1" value="{{ old('image_desc_1') }}">

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
            <img id="previewImage2" class="preview-img" src="#" alt="No image choosen">

            @error('image_2')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="image_desc_2">Image 2 Description</label>
            <input id="image_desc_2" name="image_desc_2" value="{{ old('image_desc_2') }}">

            @error('image_desc_2')
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


<script type="text/javascript">
    function displayFileName(input, index) {
        event.preventDefault();
        const fileNameDisplay = document.getElementById('file-name-display-' + index);

        if (input.files && input.files[0]) {
            fileNameDisplay.textContent = input.files[0].name;
        }

        const file = input.files[0];
        var preview = 0;

        switch (index) {
            case 1:
                preview = document.getElementById('previewImage1');
                break;

            case 2:
                preview = document.getElementById('previewImage2');
                break;

            default:
                preview = 0
                break;
        }

        if (preview != 0) {

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e);
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    }
</script>

@endsection

@section('activePage', 'awards')