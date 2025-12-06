@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Create Kurikulum</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('curriculum.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="curriculum_name">Nama Kelas</label>
            <input id="curriculum_name" name="curriculum_name" value="{{ old('curriculum_name') }}">

            @error('curriculum_name')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="price">Harga Per Bulan</label>
            <input id="price" name="price" type="number" value="{{ old('price') }}">

            @error('price')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="duration">Durasi Pembelajaran</label>
            <input id="duration" name="duration" type="number" value="{{ old('duration') }}">

            @error('duration')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div style="display: flex; gap: 20px; flex-direction:row;">
            <div style="width: 50%;">
                <label for="age_min">Umur (Min.)</label>
                <input id="age_min" name="age_min" type="number" value="{{ old('age_min') }}">

                @error('age_min')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div style="width: 50%;">
                <label for="age_max">Umur (Max.)</label>
                <input id="age_max" name="age_max" type="number" value="{{ old('age_max') }}">

                @error('age_max')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div>
            <label for="description">Deskripsi curriculum</label>
            <input id="description" name="description" value="{{ old('description') }}">

            @error('description')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="details">Details Kurikulum</label>
            <textarea id="details" name="details" value="{{ old('details') }}" class="editor"></textarea>

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
            <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">

            @error('image_path')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="image_description">Gambar Kurikulum Description</label>
            <input id="image_description" name="image_description" value="{{ old('image_description') }}">

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

@endsection

@section('activePage', 'curriculum')