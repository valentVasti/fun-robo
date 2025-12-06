@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Benefit</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>

<div class="main-content benefit-container">
    @foreach($benefit as $data)
    <div class="benefit-item-container">
        <h3>{{ $data->id }}</h3>
        <div class="mascot-container">
            <img id="mascot1" alt="{{ $data->mascot_path }}" src="{{ asset('images/mascot/' . $data->mascot_path) }}">
        </div>
        <div class="text-benefit-container">
            {{ $data->benefit }}
        </div>
        <div class="action-container">
            <button class="edit-benefit-btn" onclick="openEditModal('{{ $data->id }}')">
                <div>
                    <i class="fa-regular fa-pen-to-square fa-2xl"></i>
                </div>
                <div>
                    <p>Edit Data</p>
                </div>
            </button>
            <div class="last-updated">
                <span>Last Updated</span>
                <span>{{ $data->updated_at }}</span>
            </div>
        </div>
    </div>
    @endforeach

    <!-- <div id="preloader" class="text-center" style="position:absolute; display:block; height:100%; width:100%">
        <div class="spinner">
        </div>
    </div> -->

    <div id="edit-benefit-modal" style="display: none;">
        <div id="mascot-modal" style="display: flex; gap: 20px; flex-direction:column; text-align:center;">
            <h5>Select Mascot</h5>
            <div style="display: flex; gap: 20px;">
                <img class="mascot-selection" src="{{ asset('images/mascot/Fani01.png') }}" alt="FunRobo" data-name="Fani01.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Fani02.png') }}" alt="FunRobo" data-name="Fani02.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Fani03.png') }}" alt="FunRobo" data-name="Fani03.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Fani04.png') }}" alt="FunRobo" data-name="Fani04.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Fani05.png') }}" alt="FunRobo" data-name="Fani05.png" onclick="setSelected(this)" />
            </div>
            <div style="display: flex; gap: 20px;">
                <img class="mascot-selection" src="{{ asset('images/mascot/Robi01.png') }}" alt="FunRobo" data-name="Robi01.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Robi02.png') }}" alt="FunRobo" data-name="Robi02.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Robi03.png') }}" alt="FunRobo" data-name="Robi03.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Robi04.png') }}" alt="FunRobo" data-name="Robi04.png" onclick="setSelected(this)" />
                <img class="mascot-selection" src="{{ asset('images/mascot/Robi05.png') }}" alt="FunRobo" data-name="Robi05.png" onclick="setSelected(this)" />
            </div>

            <h5>Benefit</h5>
            <textarea type="text" id="benefit-input" onchange="setInputedBenefit(this)"></textarea>

            <button id="save-changes-mascot" onclick="saveEditedBenefit()">
                <div id="save-text">
                    Save Changes
                </div>
            </button>


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

                button {
                    width: 100%;
                    border-radius: 999px;
                    border-style: none;
                    padding: 10px;
                    background-color: var(--secondary-blue);
                    color: var(--color-text-white);
                    transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
                    will-change: transform;
                }

                button:disabled {
                    background-color: gray;
                    color: rgb(228, 228, 228);
                }

                button:hover {
                    transform: scale(1.01);
                }

                textarea {
                    padding: 10px;
                }
            </style>

        </div>
    </div>

    <style>
        .benefit-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .benefit-item-container {
            position: relative;
            height: 250px;
            background-color: rgb(228, 228, 228);
            border-radius: 12px;
            padding: 20px;
            padding-top: 45px;
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .benefit-item-container h3 {
            position: absolute;
            top: 0;
            background-color: white;
            width: 50px;
            padding: 5px;
            text-align: center;
            border-radius: 0px 0px 20px 20px;
        }

        .mascot-container {
            height: 100%;
            width: 20%;
            border-radius: 8px;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mascot-container img {
            height: 150px;
            width: auto;
        }

        .text-benefit-container {
            height: 100%;
            width: 60%;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
        }

        .action-container {
            width: 20%;
            height: 100%;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .action-container .last-updated {
            height: auto;
            width: 100%;
            background-color: rgb(228, 228, 228);
            padding: 10px;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
        }

        .action-container button {
            width: 100%;
            height: 80%;
            border-style: none;
            padding: 10px;
            border-radius: 6px;
            background-color: var(--secondary-blue);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .benefit-item-container button div {
            width: fit-content;
        }
    </style>

    <script type="text/javascript">
        const editBenefitTemplate = document.getElementById('edit-benefit-modal');
        const mascotImages = document.querySelectorAll('.mascot-selection');

        let selectedMascot
        let selectedId
        let inputedBenefit

        document.addEventListener('DOMContentLoaded', function() {
            // const editBtns = document.querySelectorAll('.edit-benefit-btn');

            // editBtns.forEach(element => {
            //     element.addEventListener('click', function() {
            //         Swal.fire({
            //             title: "Edit Benefit",
            //             html: editBenefitTemplate.innerHTML,
            //             width: 'auto',
            //             showCancelButton: true,
            //             showLoaderOnConfirm: false,
            //             showConfirmButton: false
            //         });
            //     });
            // });
        });

        function setSelected(element) {
            var images = document.querySelectorAll('.mascot-selection');

            images.forEach(image => {
                image.classList.remove('active');
            });

            selectedMascot = element;
            element.classList.toggle('active');
        }

        function openEditModal(id) {
            Swal.fire({
                title: "Edit Benefit " + id,
                html: editBenefitTemplate.innerHTML,
                width: 'auto',
                showCancelButton: true,
                showLoaderOnConfirm: false,
                showConfirmButton: false
            });

            selectedId = id
        }

        function setInputedBenefit(element) {
            inputedBenefit = element.value;
        }

        function saveEditedBenefit() {
            const benefitInputs = document.getElementById('benefit-input');

            console.log('SelectedId:', selectedId);
            console.log('Selected Mascot:', selectedMascot);
            console.log('Inputed Benefit: ', inputedBenefit);

            const data = new FormData();

            data.append('id', selectedId);
            data.append('mascot_path', selectedMascot.dataset.name);
            data.append('benefit', inputedBenefit);

            updateData(data)
                .then(updatedData => {
                    console.log('Data updated successfully:', updatedData);
                    // Handle the updated data as needed
                    window.location.reload();
                })
                .catch(error => {
                    // Handle errors that occurred during the update
                    console.error('Error updating data:', error);
                });
        }

        async function updateData(data) {
            try {
                const response = await fetch('benefit/update', {
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
                return updatedData;
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
                throw error;
            }
        }
    </script>

    @endsection

    @section('activePage', 'benefit')