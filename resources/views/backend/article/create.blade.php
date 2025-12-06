@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>
<script src="{{ mix('js/radioArticle.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/form.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Create Article</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="judul">Judul Artikel</label>
            <input id="judul" name="judul" value="{{ old('judul') }}">

            @error('judul')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="penulis">Penulis Artikel</label>
            <input id="penulis" name="penulis" value="{{ old('penulis') }}">

            @error('penulis')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="isi">Isi Artikel</label>
            <textarea id="isi" name="isi" class="editor">{{ old('isi') }}</textarea>

            @error('isi')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="tag">Tag (Category)</label>
            <p id="selected-tag">Selected Tag: </p>
            <select id="select-tag" name="tag" data-selectedId="0">
                <option disabled selected>Select Tag...</option>
            </select>

            @error('article_tag')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
            <input id="article-tag" name="article_tag" value="" class="hidden" />
        </div>

        <div>
            <label>Thumbnail</label>
            <div class="file-container" data-index="1">
                <label for="thumbnail" class="upload-btn">Upload File</label>
                <span id="file-name-display-1" class="file-name-display">No image chosen</span>
            </div>
            <input type="file" id="thumbnail" name="thumbnail" onchange="displayFileName(this, 1)">
            <img id="previewImage1" class="preview-img" src="#" alt="No image choosen">

            @error('thumbnail')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="thumbnail_desc">Thumbnail Description</label>
            <input id="thumbnail_desc" name="thumbnail_desc" value="{{ old('thumbnail_desc') }}">

            @error('thumbnail_desc')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label for="thumbnail_caption">Thumbnail Caption</label>
            <input id="thumbnail_caption" name="thumbnail_caption" value="{{ old('thumbnail_caption') }}">

            @error('thumbnail_caption')
            <div class="error-message">
                {{ $message }}
            </div>
            @enderror
        </div>

        <p>Pilih jumlah gambar di artikel</p>

        <div id="radio-group" class="radio-group" style="gap: 20px;" data-count="0">
            <div class="radio-button">
                <input type="radio" id="radio_1" name="radio-group" value="1_img">
                <label for="option1">1</label><br>
            </div>

            <div class="radio-button">
                <input type="radio" id="radio_2" name="radio-group" value="2_img">
                <label for="option2">2</label><br>
            </div>

            <div class="radio-button">
                <input type="radio" id="radio_3" name="radio-group" value="3_img">
                <label for="option2">3</label><br>
            </div>
        </div>

        <div id="article_img_1" class="article-img-container">
            <div>
                <label>Article Image 1</label>
                <div class="file-container" data-index="1">
                    <label for="article_image_1" class="upload-btn">Upload File</label>
                    <span id="file-name-display-2" class="file-name-display">No image chosen</span>
                </div>
                <input type="file" id="article_image_1" name="article_image_1" onchange="displayFileName(this, 2)">
                <img id="previewImage2" class="preview-img" src="#" alt="No image choosen">

                @error('article_image_1')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="article_image_1_desc">Article Image 1 Description</label>
                <input id="article_image_1_desc" name="article_image_1_desc" value="{{ old('article_image_1_desc') }}">

                @error('article_image_1_desc')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="article_image_1_capt">Article Image 1 Caption</label>
                <input id="article_image_1_capt" name="article_image_1_capt" value="{{ old('article_image_1_capt') }}">

                @error('article_image_1_capt')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <hr />
        </div>

        <div id="article_img_2" class="article-img-container">
            <div>
                <label>Article Image 2</label>
                <div class="file-container" data-index="1">
                    <label for="article_image_2" class="upload-btn">Upload File</label>
                    <span id="file-name-display-3" class="file-name-display">No image chosen</span>
                </div>
                <input type="file" id="article_image_2" name="article_image_2" onchange="displayFileName(this, 3)">
                <img id="previewImage3" class="preview-img" src="#" alt="No image choosen">

                @error('article_image_2')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="article_image_2_desc">Article Image 2 Description</label>
                <input id="article_image_2_desc" name="article_image_2_desc" value="{{ old('article_image_2_desc') }}">

                @error('article_image_2_desc')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="article_image_2_capt">Article Image 2 Caption</label>
                <input id="article_image_2_capt" name="article_image_2_capt" value="{{ old('article_image_2_capt') }}">

                @error('article_image_2_capt')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <hr />
        </div>

        <div id="article_img_3" class="article-img-container">
            <div>
                <label>Article Image 3</label>
                <div class="file-container" data-index="1">
                    <label for="article_image_3" class="upload-btn">Upload File</label>
                    <span id="file-name-display-4" class="file-name-display">No image chosen</span>
                </div>
                <input type="file" id="article_image_3" name="article_image_3" onchange="displayFileName(this, 4)">
                <img id="previewImage4" class="preview-img" src="#" alt="No image choosen">

                @error('article_image_3')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="article_image_3_desc">Article Image 3 Description</label>
                <input id="article_image_3_desc" name="article_image_3_desc" value="{{ old('article_image_3_desc') }}">

                @error('article_image_3_desc')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="article_image_3_capt">Article Image 3 Caption</label>
                <input id="article_image_3_capt" name="article_image_3_capt" value="{{ old('article_image_3_capt') }}">

                @error('article_image_3_capt')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <hr />
        </div>

        <div class="btn-group">
            <button id="submit-btn">Submit</button>
            
        </div>
    </form>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('select-tag');
        const selectedTag = document.getElementById('selected-tag');
        const allRemoveBtn = document.getElementsByClassName('remove-tag');
        const inputTag = document.getElementById('article-tag');
        var select_arr = []

        getAllTag();

        select.addEventListener("change", function() {
            console.log(select.value)
            if (checkSelected(select_arr, select.value)) {
                var selectedOption = select.options[select.selectedIndex];
                select_arr.push({
                    'id': selectedOption.dataset.id,
                    'value': select.value
                });
                inputTag.value = JSON.stringify(select_arr);
                console.log('Value inside input Tag: ', inputTag.value)
                setSelected(select.value, selectedOption.dataset.id);
            }

            Array.from(allRemoveBtn).forEach(element => {
                element.addEventListener('click', function() {
                    const idToDelete = element.id; // Replace with the ID you want to delete

                    const indexToDelete = select_arr.findIndex(obj => obj.id === idToDelete);
                    if (indexToDelete !== -1) {
                        select_arr.splice(indexToDelete, 1);

                        inputTag.value = JSON.stringify(select_arr);
                        console.log('Value inside input Tag del: ', inputTag.value)

                        console.log(select_arr);

                        let parentElement = element.parentElement;

                        while (parentElement) {
                            if (!parentElement.id) {
                                break; // Found the first ancestor without an ID
                            }
                            parentElement = parentElement.parentElement;
                        }

                        // Remove the child element and its first ancestor without an ID
                        if (parentElement) {
                            parentElement.remove(); // Remove the ancestor without an ID
                            element.remove(); // Remove the child element
                        }
                    }
                })
            });
        })

        function checkSelected(select_arr, value) {
            for (let i = 0; i < select_arr.length; i++) {
                console.log('Value in arr: ', select_arr[i].value, 'Value selected: ', value)
                if (select_arr[i].value == value) {
                    console.log(false);
                    return false
                }
            }

            return true
        }

        function setSelected(value, id) {
            var newSelected = document.createElement('span');
            var newRemoveBtn = document.createElement('i');

            newRemoveBtn.classList.add('fa-regular', 'fa-circle-xmark', 'fa-sm', 'remove-tag');
            newRemoveBtn.setAttribute('id', id);

            newSelected.innerHTML = value + " ";
            newSelected.appendChild(newRemoveBtn);

            selectedTag.appendChild(newSelected);
        };
    })

    function getAllTag() {
        var allData;

        fetch("/admin/tag/getAll")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse response body as JSON
            })
            .then(data => {
                setOption(data.data);
            })
            .catch(error => {
                // Handle errors during the fetch
                console.error('Error:', error);
            });
    }

    function setOption(allData) {
        const select = document.getElementById('select-tag');

        allData.forEach(data => {
            var newOption = document.createElement('option');

            newOption.value = data.tag_name
            newOption.setAttribute('data-id', data.id)
            newOption.innerHTML = data.tag_name

            select.appendChild(newOption)
        });

    }
</script>

@endsection

@section('activePage', 'article')