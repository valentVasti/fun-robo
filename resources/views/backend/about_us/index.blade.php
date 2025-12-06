@extends('backend.sidebar')

@section('content')

<script src="{{ mix('js/previewimg.js') }}" type="text/javascript"></script>

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/aboutUs.css') }}" rel="stylesheet">

<div class="section-header">
    <h1 id="about-us-title" data-url="{{ asset('images/database/aboutUs') }}">About Us Page Data</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="upper-container">
    <div class="main-content mascot-container">
        <h3>Mascot</h3>
        <h4>Selected Mascot:</h4>
        <div class="mascot-img-container">
            <img id="mascot1" alt="Mascot 1">
            <img id="mascot2" alt="Mascot 2">
        </div>
        <button id="mascot-btn">
            Change Mascot
        </button>
    </div>
    <div class="main-content image-container">
        <h3>About Us Image</h3>
        <div class="image-img-container">
            <img id="image1" alt="Image 1">
            <img id="image2" alt="Image 2">
        </div>
        <button id="image-btn">
            Change Image
        </button>
    </div>
    <div class="main-content landing-image-container">
        <h3>Landing About Us Image</h3>
        <div class="image-img-container">
            <img id="landingImage" alt="Image 1">
        </div>
        <button id="landing-image-btn">
            Change Image
        </button>
    </div>
</div>
<div class="main-content text-container">
    <h3>Short Text About</h3>
    <div class="short-text-container">
        <textarea id="shortText">
        </textarea>
    </div>
    <button id="shortText-btn" onclick="saveShortTextChanges()" disabled>
        Save Short Text Changes
    </button>
</div>
<div class="main-content text-container">
    <h3>Long Text About</h3>
    <div class="long-text-container">
        <textarea id="longText">
        </textarea>
    </div>
    <button id="longText-btn" onclick="saveLongTextChanges()" disabled>
        Save Long Text Changes
    </button>
</div>
<div class="main-content text-container">
    <h3>Home Text About</h3>
    <div class="long-text-container">
        <textarea id="homeText">
        </textarea>
    </div>
    <button id="homeText-btn" onclick="saveHomeTextChanges()" disabled>
        Save Home Text Changes
    </button>
</div>

<div id="change-mascot-modal" style="display: none;">
    <div id="mascot-modal" style="display: flex; gap: 20px; flex-direction:column; text-align:center;">
        <h5>Mascot 1</h5>
        <div id="select-mascot-1" style="display: flex; gap: 20px;">
            <img class="mascot-selection-1" src="{{ asset('images/mascot/Fani01.png') }}" alt="FunRobo" data-name="Fani01.png" onclick="setSelected1(this)" />
            <img class="mascot-selection-1" src="{{ asset('images/mascot/Fani02.png') }}" alt="FunRobo" data-name="Fani02.png" onclick="setSelected1(this)" />
            <img class="mascot-selection-1" src="{{ asset('images/mascot/Fani03.png') }}" alt="FunRobo" data-name="Fani03.png" onclick="setSelected1(this)" />
            <img class="mascot-selection-1" src="{{ asset('images/mascot/Fani04.png') }}" alt="FunRobo" data-name="Fani04.png" onclick="setSelected1(this)" />
            <img class="mascot-selection-1" src="{{ asset('images/mascot/Fani05.png') }}" alt="FunRobo" data-name="Fani05.png" onclick="setSelected1(this)" />
        </div>

        <h5>Mascot 2</h5>
        <ul id="select-mascot-2" style="display: flex; gap: 20px;">
            <img class="mascot-selection-2" src="{{ asset('images/mascot/Robi01.png') }}" alt="FunRobo" data-name="Robi01.png" onclick="setSelected2(this)" />
            <img class="mascot-selection-2" src="{{ asset('images/mascot/Robi02.png') }}" alt="FunRobo" data-name="Robi02.png" onclick="setSelected2(this)" />
            <img class="mascot-selection-2" src="{{ asset('images/mascot/Robi03.png') }}" alt="FunRobo" data-name="Robi03.png" onclick="setSelected2(this)" />
            <img class="mascot-selection-2" src="{{ asset('images/mascot/Robi04.png') }}" alt="FunRobo" data-name="Robi04.png" onclick="setSelected2(this)" />
            <img class="mascot-selection-2" src="{{ asset('images/mascot/Robi05.png') }}" alt="FunRobo" data-name="Robi05.png" onclick="setSelected2(this)" />
        </ul>
        <button id="save-changes-mascot" onclick="saveMascotChanges()">Save Changes</button>
    </div>

    <style>
        #mascot-modal {
            padding: 10px;
        }

        #mascot-modal img {
            width: 100px;
            height: auto;
            object-fit: contain;
            box-shadow: 0px 0px 10px 0px rgb(207, 207, 207);
            padding: 10px;
            border-radius: 10px;
            transition: background-color 0.5s ease;
        }

        #mascot-modal img.active {
            background-color: rgb(177, 177, 177);
        }
    </style>

</div>

<div id="change-image-modal" style="display: none;">
    <div style="padding: 10px;">
        <div id="form-image-container">
            <div class="image-input-container">
                <div class="input-container">
                    <label>Image 1</label>
                    <input type="file" onchange="setNewImage1(this)" />
                </div>
            </div>

            <div class="image-input-container">
                <div class="input-container">
                    <label>Image 2</label>
                    <input type="file" onchange="setNewImage2(this)" />
                </div>
            </div>

        </div>

        <button id="save-changes-image" onclick="saveImageChanges()">Update Image</button>

        <style>
            #form-image-container {
                display: flex;
                gap: 20px;
                margin-top: 20px;
            }

            #form-image-container .image-input-container {
                height: max-content;
                width: 50%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            #form-image-container .image-preview {
                height: 80%;
                border: solid 1px black;
                border-radius: 10px;
            }

            #form-image-container .input-container {
                height: 20%;
                display: flex;
                align-items: center;
                justify-content: space-evenly;
                gap: 10px;
            }

            #form-image-container .input-container label {
                width: 30%;
            }

            #save-changes-image {
                margin-top: 50px;
            }
        </style>
    </div>
</div>

<div id="change-landing-image-modal" style="display: none;">
    <div style="padding: 10px;">
        <div id="form-image-container">
            <div class="image-input-container">
                <div class="input-container">
                    <label>Landing Image</label>
                    <input type="file" onchange="setNewLandingImage(this)" />
                </div>
            </div>
        </div>

        <button id="save-changes-image" onclick="saveLandingImageChanges()">Update Image</button>

        <style>
            #form-image-container {
                display: flex;
                gap: 20px;
                margin-top: 20px;
            }

            #form-image-container .image-input-container {
                height: max-content;
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            #form-image-container .input-container {
                height: 20%;
                display: flex;
                align-items: center;
                justify-content: space-evenly;
                gap: 10px;
            }

            #form-image-container .input-container label {
                width: 30%;
            }

            #save-changes-image {
                margin-top: 50px;
            }
        </style>
    </div>
</div>

<script type="text/javascript">
    const mascotBtn = document.getElementById('mascot-btn');
    const imageBtn = document.getElementById('image-btn');
    const landingImageBtn = document.getElementById('landing-image-btn');
    const longTextBtn = document.getElementById('longText-btn');
    const homeTextBtn = document.getElementById('homeText-btn');
    const shortTextBtn = document.getElementById('shortText-btn');

    const saveChangesMascot = document.getElementById('save-changes-mascot');

    const changeMascotTemplate = document.getElementById('change-mascot-modal');
    const changeImageTemplate = document.getElementById('change-image-modal');
    const changeLandingImageTemplate = document.getElementById('change-landing-image-modal');


    const title = document.getElementById('about-us-title');
    const imgPath = title.dataset.url
    const mascot1 = document.getElementById('mascot1');
    const mascot2 = document.getElementById('mascot2');
    const image1 = document.getElementById('image1');
    const image2 = document.getElementById('image2');
    const landingImage = document.getElementById('landingImage');
    const longText = document.getElementById('longText');
    const homeText = document.getElementById('homeText');
    const shortText = document.getElementById('shortText');
    var images1 = document.querySelectorAll('.mascot-selection-1');
    var images2 = document.querySelectorAll('.mascot-selection-2');

    let selectedMascot1
    let selectedMascot2

    let newImage1
    let newImage2

    let newLandingImage

    let homeTextEditor
    let longTextEditor
    let shortTextEditor

    const editorConfig = {
        items: [
            'undo', 'redo',
            '|', 'heading',
            '|', 'bold', 'italic',
            '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
        ],
        shouldNotGroupWhenFull: false,
    };

    document.addEventListener('DOMContentLoaded', function() {
        fetchAnalytics();

        mascotBtn.addEventListener('click', function() {
            Swal.fire({
                title: "Select Mascot",
                html: changeMascotTemplate.innerHTML,
                width: 'auto',
                showCancelButton: true,
                showLoaderOnConfirm: false,
                showConfirmButton: false
            });
        });

        imageBtn.addEventListener('click', function() {
            Swal.fire({
                title: "Update Image",
                html: changeImageTemplate.innerHTML,
                width: 'auto',
                showCancelButton: true,
                showLoaderOnConfirm: false,
                showConfirmButton: false
            });
        });

        landingImageBtn.addEventListener('click', function() {
            Swal.fire({
                title: "Update Image",
                html: changeLandingImageTemplate.innerHTML,
                width: 'auto',
                showCancelButton: true,
                showLoaderOnConfirm: false,
                showConfirmButton: false
            });
        });
    });


    async function fetchAnalytics() {
        let response = await fetch('about_us/getAllData');
        let data = await response.json();

        mascot1.setAttribute('src', imgPath + "/" + data.data.mascot1.content);
        mascot2.setAttribute('src', imgPath + "/" + data.data.mascot2.content);
        image1.setAttribute('src', imgPath + "/" + data.data.image1.content);
        image2.setAttribute('src', imgPath + "/" + data.data.image2.content);
        landingImage.setAttribute('src', imgPath + "/" + data.data.landingImage.content);

        ClassicEditor
            .create(longText, {
                toolbar: editorConfig
            })
            .then(editor => {
                editor.setData(data.data.longText.content)
                editor.model.document.on('change:data', function() {
                    longTextBtn.disabled = false;
                });
                longTextEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(homeText, {
                toolbar: editorConfig
            })
            .then(editor => {
                editor.setData(data.data.homeText.content)
                editor.model.document.on('change:data', function() {
                    homeTextBtn.disabled = false;
                });
                homeTextEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(shortText, {
                toolbar: editorConfig
            })
            .then(editor => {
                editor.setData(data.data.shortText.content)
                editor.model.document.on('change:data', function() {
                    shortTextBtn.disabled = false;
                });
                shortTextEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }

    function setSelected1(element) {
        var images = document.querySelectorAll('.mascot-selection-1');

        images.forEach(image => {
            image.classList.remove('active');
        });

        selectedMascot1 = element;
        element.classList.toggle('active');
    }

    function setSelected2(element) {
        var images = document.querySelectorAll('.mascot-selection-2');

        images.forEach(image => {
            image.classList.remove('active');
        });

        selectedMascot2 = element;
        element.classList.toggle('active');
    }

    function setNewImage1(element) {
        newImage1 = element;
        console.log(newImage1);
    }

    function setNewImage2(element) {
        newImage2 = element;
        console.log(newImage2);
    }

    function setNewLandingImage(element) {
        newLandingImage = element;
        console.log(newLandingImage);
    }

    async function updateData(data) {

        try {
            const response = await fetch('about_us/update', {
                method: 'POST',
                body: data,
                headers: {
                    // 'Content-Type': 'application/json',
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            });

            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }

            const updatedData = await response.json();
            Swal.close();
            window.location.reload();
            return updatedData;
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
            throw error;
        }
    }

    function saveMascotChanges() {
        if (selectedMascot1 !== undefined) {

            const data = new FormData();

            data.append('type', 'mascot1');
            data.append('content', selectedMascot1.dataset.name);

            updateData(data)
                .then(updatedData => {
                    console.log('Data updated successfully:', updatedData);
                    // Handle the updated data as needed
                })
                .catch(error => {
                    // Handle errors that occurred during the update
                    console.error('Error updating data:', error);
                });
        }

        if (selectedMascot2 !== undefined) {

            const data = new FormData();

            data.append('type', 'mascot2');
            data.append('content', selectedMascot2.dataset.name);

            updateData(data)
                .then(updatedData => {
                    console.log('Data updated successfully:', updatedData);
                    // Handle the updated data as needed
                })
                .catch(error => {
                    // Handle errors that occurred during the update
                    console.error('Error updating data:', error);
                });
        }

        window.location.reload()
    }

    function saveImageChanges() {
        if (newImage1 !== undefined) {

            const data = new FormData();

            data.append('type', 'image1');
            data.append('content', newImage1.files[0]);

            updateData(data)
                .then(updatedData => {
                    console.log('Data updated successfully:', updatedData);
                    // Handle the updated data as needed
                })
                .catch(error => {
                    // Handle errors that occurred during the update
                    console.error('Error updating data:', error);
                });
        }

        if (newImage2 !== undefined) {

            const data = new FormData();

            data.append('type', 'image2');
            data.append('content', newImage2.files[0]);

            updateData(data)
                .then(updatedData => {
                    console.log('Data updated successfully:', updatedData);
                    // Handle the updated data as needed
                })
                .catch(error => {
                    // Handle errors that occurred during the update
                    console.error('Error updating data:', error);
                });
        }

        window.location.reload()
    }

    function saveLandingImageChanges() {
        if (newLandingImage !== undefined) {

            const data = new FormData();

            data.append('type', 'landingImage');
            data.append('content', newLandingImage.files[0]);

            updateData(data)
                .then(updatedData => {
                    console.log('Data updated successfully:', updatedData);
                    // Handle the updated data as needed
                })
                .catch(error => {
                    // Handle errors that occurred during the update
                    console.error('Error updating data:', error);
                });
        }

        // window.location.reload()
    }

    function saveLongTextChanges() {
        // const existingEditor = ClassicEditor
        //     .instances('longText');

        // const editor = window.CKEDITOR.instances['longText']; // Replace 'editor' with your textarea's ID

        const data = new FormData();

        data.append('type', 'longText');
        data.append('content', longTextEditor.getData());

        updateData(data)
            .then(updatedData => {
                console.log('Data updated successfully:', updatedData);
                // Handle the updated data as needed
            })
            .catch(error => {
                // Handle errors that occurred during the update
                console.error('Error updating data:', error);
            });

        console.log(longTextEditor.getData())
    }

    function saveHomeTextChanges() {
        // const existingEditor = ClassicEditor
        //     .instances.get('homeText');

        // const editor = window.CKEDITOR.instances['homeText']; // Replace 'editor' with your textarea's ID

        const data = new FormData();

        data.append('type', 'homeText');
        data.append('content', homeTextEditor.getData());

        updateData(data)
            .then(updatedData => {
                console.log('Data updated successfully:', updatedData);
                // Handle the updated data as needed
            })
            .catch(error => {
                // Handle errors that occurred during the update
                console.error('Error updating data:', error);
            });

        console.log(homeTextEditor.getData())
    }

    function saveShortTextChanges() {
        // const existingEditor = ClassicEditor
        //     .instances.get('homeText');

        // const editor = window.CKEDITOR.instances['homeText']; // Replace 'editor' with your textarea's ID

        const data = new FormData();

        data.append('type', 'shortText');
        data.append('content', shortTextEditor.getData());

        updateData(data)
            .then(updatedData => {
                console.log('Data updated successfully:', updatedData);
                // Handle the updated data as needed
            })
            .catch(error => {
                // Handle errors that occurred during the update
                console.error('Error updating data:', error);
            });

        console.log(shortTextEditor.getData())
    }
</script>

@endsection

@section('activePage', 'curriculum')