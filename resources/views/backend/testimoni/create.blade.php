@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Create Testimoni</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('testimoni.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nama_testimoni">Nama Testimonee</label>
            <input id="nama_testimoni" name="nama_testimoni" value="{{ old('nama_testimoni') }}">

            @error('nama_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="keterangan_testimoni">Keterangan Testimonee</label>
            <input id="keterangan_testimoni" name="keterangan_testimoni" value="{{ old('keterangan_testimoni') }}">

            @error('keterangan_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="umur_testimoni">Umur Testimonee</label>
            <input id="umur_testimoni" name="umur_testimoni" type="number" value="{{ old('umur_testimoni') }}">

            @error('umur_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="isi_testimoni">Isi Testimoni</label>
            <input id="isi_testimoni" name="isi_testimoni" value="{{ old('isi_testimoni') }}">

            @error('isi_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label>Gambar Testimonee</label>
            <div class="file-container" data-index="1">
                <label for="gambar_testimoni" class="upload-btn">Upload File</label>
                <span id="file-name-display-1" class="file-name-display">No image chosen</span>
            </div>
            <input type="file" id="gambar_testimoni" name="gambar_testimoni" onchange="displayFileName(this, 1)">
            <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">

            @error('gambar_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="gambar_testimoni_desc">Gambar Testimoni Description</label>
            <input id="gambar_testimoni_desc" name="gambar_testimoni_desc" value="{{ old('gambar_testimoni_desc') }}">

            @error('gambar_testimoni_desc')
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

@section('activePage', 'awards')