@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Edit Testimoni</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('testimoni.update', ['id' => $testimoni->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_testimoni">Nama Testimonee</label>
            <input id="nama_testimoni" name="nama_testimoni" value="{{ $testimoni->nama_testimoni }}">

            @error('nama_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="keterangan_testimoni">Keterangan Testimonee</label>
            <input id="keterangan_testimoni" name="keterangan_testimoni" value="{{ $testimoni->keterangan_testimoni }}">

            @error('keterangan_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="umur_testimoni">Umur Testimonee</label>
            <input id="umur_testimoni" name="umur_testimoni" type="number" value="{{ $testimoni->umur_testimoni }}">

            @error('umur_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="isi_testimoni">Isi Testimoni</label>
            <input id="isi_testimoni" name="isi_testimoni" value="{{ $testimoni->isi_testimoni }}">

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
            <div class="preview-container">
                <div>
                    <p class="new-img-text">New Image</p>
                    <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">
                </div>
                <div>
                    <p class="ex-img-text">Existing Image</p>
                    <img class="preview-img" src="{{ asset('images/database/testimoni/'.$testimoni->gambar_testimoni) }}" alt="No image choosen">
                </div>
            </div>

            @error('gambar_testimoni')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for=" gambar_testimoni_desc">Gambar Testimoni Description</label>
                <input id="gambar_testimoni_desc" name="gambar_testimoni_desc" value="{{ $testimoni->gambar_testimoni_desc }}">

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