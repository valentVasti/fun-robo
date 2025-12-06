@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>
<script src="{{ mix('js/radioArticle.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Edit Article</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('branch.update', ['id' => $branch->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_branch">Nama Branch</label>
            <input id="nama_branch" name="nama_branch" value="{{ $branch->nama_branch }}">

            @error('nama_branch')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="alamat">Alamat</label>
            <input id="alamat" name="alamat" value="{{ $branch->alamat }}">

            @error('alamat')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="provinsi">Provinsi</label>
            <input id="provinsi" name="provinsi" value="{{ $branch->provinsi }}">

            @error('provinsi')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="kota">Kota</label>
            <input id="kota" name="kota" value="{{ $branch->kota }}">

            @error('kota')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" name="email" value="{{ $branch->email }}">

            @error('email')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label>Gambar Branch</label>
            <div class="file-container" data-index="1">
                <label for="gambar_branch" class="upload-btn">Upload File</label>
                <span id="file-name-display-1" class="file-name-display">No image chosen</span>
            </div>
            <input type="file" id="gambar_branch" name="gambar_branch" onchange="displayFileName(this, 1)">
            <div class="preview-container">
                <div>
                    <p class="new-img-text">New Image</p>
                    <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">
                </div>
                <div>
                    <p class="ex-img-text">Existing Image</p>
                    <img class="preview-img" src="{{ asset('images/database/branch/'.$branch->gambar_branch) }}" alt="No image choosen">
                </div>
            </div>

            @error('gambar_branch')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="gambar_branch_desc">Gambar Branch Description</label>
            <input id="gambar_branch_desc" name="gambar_branch_desc" value="{{ $branch->gambar_branch_desc }}">

            @error('gambar_branch_desc')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="phone_num">No. Telepon</label>
            <input id="phone_num" name="phone_num" value="{{ $branch->phone_num }}">

            @error('phone_num')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="flex-form">
            <div>
                <label for="instagram">Instagram</label>
                <input id="instagram" name="instagram" value="{{ $branch->instagram }}">

                @error('instagram')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="link_instagram">Link Instagram</label>
                <input id="link_instagram" name="link_instagram" value="{{ $branch->link_instagram }}">

                @error('link_instagram')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="flex-form">
            <div>
                <label for="facebook">Facebook</label>
                <input id="facebook" name="facebook" value="{{ $branch->facebook }}">

                @error('facebook')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="link_facebook">Link Facebook</label>
                <input id="link_facebook" name="link_facebook" value="{{ $branch->link_facebook }}">

                @error('link_facebook')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div>
            <label for="link_gmaps">Embedded Google Maps <i id="embed-maps-info" class="fa-solid fa-circle-info"></i></label>
            <input id="link_gmaps" name="link_gmaps" value="{{ $branch->link_gmaps }}">

            @error('link_gmaps')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="btn-group">
            <button id="submit-btn">Submit</button>
            
        </div>
    </form>
    <template id="embed-maps-info-modal">
        <swal-title> Cara Mendapatkan Embedded Google Maps</swal-title>
        <swal-html>
            <ol style="text-align: left;">
                <li>1. Buka <a href="https://www.google.com/maps" target="_blank">Google Maps</a></li>
                <br>
                <li>2. Cari cabang yang ada di Google Maps</li>
                <br>
                <li>3. Klik bagikan
                    <p>
                    <div style="margin-top: 20px;">
                        <img style="border-radius: 10px;" src="{{ asset('images/embedInfo/click-share.png') }}" width="700px" height="auto" />
                    </div>
                    </p>
                </li>
                <br>
                <li>3. Klik sematkan peta
                    <p>
                    <div style="margin-top: 20px;">
                        <img style="border-radius: 10px;" src="{{ asset('images/embedInfo/embed-maps.png') }}" width="700px" height="auto" />
                    </div>
                    </p>
                </li>
                <br>
                <li>3. Copy link di dalam atribut src sampai akhir
                    <div style="margin-block: 20px;">
                        <img style="border-radius: 10px;" src="{{ asset('images/embedInfo/embed-link.png') }}" width="700px" height="auto" />
                    </div>
                    </p>
                    <div style="width: 700px; font-size:small">
                        <p>Contoh Embedded Link yang benar: </p>
                        <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0651087539636!2d110.36450077505216!3d-7.7829217922367695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a591a4d553bd5%3A0xc0f964003add568b!2sTugu%20Jogja!5e0!3m2!1sid!2sid!4v1702021133125!5m2!1sid!2sid" target="_blank">
                            https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0651087539636!2d110.36450077505216!3d-7.7829217922367695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a591a4d553bd5%3A0xc0f964003add568b!2sTugu%20Jogja!5e0!3m2!1sid!2sid!4v1702021133125!5m2!1sid!2sid
                        </a>
                        <p>&nbsp;</p>
                        <p>Ketika mengakses embedded link yang benar, maka akan muncul halaman dengan teks: <br><code>The Google Maps Embed API must be used in an iframe.</code></p>
                    </div>
                </li>
                <br>
            </ol>
        </swal-html>
        <swal-function-param name="showConfirmButton" value="true" />
        <swal-param name="showClass" value='{ "popup": "my-popup" }' />
    </template>
</div>

<script type="text/javascript">
    function displayFileName(input, index) {
        event.preventDefault();
        const fileNameDisplay = document.getElementById('file-name-display-' + index);
        const preview = document.getElementById('previewImage' + index);

        if (input.files && input.files[0]) {
            fileNameDisplay.textContent = input.files[0].name;
        }

        const file = input.files[0];

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

    const info = document.getElementById('embed-maps-info');

    info.addEventListener('click', function() {
        Swal.fire({
            width: "auto",
            template: "#embed-maps-info-modal",
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeIn
                `
            },
            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOut
                `
            },
        });
    });
</script>

@endsection

@section('activePage', 'article')