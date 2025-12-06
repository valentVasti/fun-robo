@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Edit Curriculum</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('curriculum.update', ['id' => $curriculum->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="curriculum_name">Nama Kelas</label>
            <input id="curriculum_name" name="curriculum_name" value="{{ $curriculum->curriculum_name }}">

            @error('curriculum_name')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="price">Harga Per Bulan</label>
            <input id="price" name="price" type="number" value="{{ $curriculum->price }}">

            @error('price')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="duration">Durasi Pembelajaran</label>
            <input id="duration" name="duration" type="number" value="{{ $curriculum->duration }}">

            @error('duration')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div style="display: flex; gap: 20px; flex-direction:row;">
            <div style="width: 50%;">
                <label for="age_min">Umur (Min.)</label>
                <input id="age_min" name="age_min" type="number" value="{{ $curriculum->age_min }}">

                @error('age_min')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div style="width: 50%;">
                <label for="age_max">Umur (Max.)</label>
                <input id="age_max" name="age_max" type="number" value="{{ $curriculum->age_max }}">

                @error('age_max')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div>
            <label for="description">Deskripsi Kurikulum</label>
            <input id="description" name="description" value="{{ $curriculum->description }}">

            @error('description')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="details">Details Kurikulum</label>
            <textarea id="details" name="details" value="{{ $curriculum->details }}" class="editor">{!! $curriculum->details !!}</textarea>

            @error('details')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label>Gambar Kurikulum</label>
            <div class="file-container" data-index="1">
                <label for="image_path" class="upload-btn">Upload File</label>
                <span id="file-name-display-1" class="file-name-display">No image chosen</span>
            </div>
            <input type="file" id="image_path" name="image_path" onchange="displayFileName(this, 1)">
            <div class="preview-container">
                <div>
                    <p class="new-img-text">New Image</p>
                    <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">
                </div>
                <div>
                    <p class="ex-img-text">Existing Image</p>
                    <img class="preview-img" src="{{ asset('images/database/curriculum/'.$curriculum->image_path) }}" alt="No image choosen">
                </div>
            </div>

            @error('image_path')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for=" image_description">Gambar Kurikulum Description</label>
            <input id="image_description" name="image_description" value="{{ $curriculum->image_description }}">

            @error('image_description')
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

@section('activePage', 'curriculum')