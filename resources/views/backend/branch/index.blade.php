@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/table.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Branch</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <div class="controller-section">
        <div>
            <a href="{{ route('branch.create') }}"><button><i class="fa-solid fa-circle-plus"></i>Add branch</button></a>
            <select id="dataPerPage" onchange="redirectToRoute(this.value, this, 'dataPerPage')">
                <option value="{{ route('branch.index', ['data_per_page' => 10]) }}">10</option>
                <option value="{{ route('branch.index', ['data_per_page' => 50]) }}">50</option>
                <option value="{{ route('branch.index', ['data_per_page' => 100]) }}">100</option>
                <option value="{{ route('branch.index', ['data_per_page' => 250]) }}">250</option>
                <option value="{{ route('branch.index', ['data_per_page' => 500]) }}">500</option>
            </select>
        </div>

        <input id="search" placeholder="Search...">
    </div>

    <table id="table" data-json="{{ $branch_data }}" data-page="branch" data-totalpage="{{ $branch->total() }}">
        <tr>
            <th>No. </th>
            <th>Nama Branch</th>
            <th>No. Telepon</th>
            <th>Email</th>
            <th>Informasi Detail</th>
            <th>Created At</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach($branch as $data)
        <tr id="{{ $data->id }}">
            <td>{{ $i }}</td>
            <td>{{ $data->nama_branch }}</td>
            <td>{{ $data->phone_num }}</td>
            <td>{{ $data->email }}</td>
            <td class="text-center">
                <template id="my-template-{{ $i }}">
                    <swal-html>
                        <h3>Detail Lokasi {{ $data->nama_branch }}</h3>
                        <br>

                        <p class="attribute-modal">Alamat:</p>
                        <p>{{ $data->alamat }}</p>
                        <br>

                        <p class="attribute-modal">Kota:</p>
                        <p>{{ $data->kota }}</p>
                        <br>

                        <p class="attribute-modal">Provinsi:</p>
                        <p>{{ $data->provinsi }}</p>
                        <br>
                    </swal-html>
                    <swal-function-param name="showConfirmButton" value="false" />
                </template>
                <span>
                    <button id="location-detail" class="location-detail">
                        <i class="fa-solid fa-house pointer"></i>
                    </button>
                </span><span><a href="{{ $data->link_instagram }}" class="instagram pointer"><i class="fa-brands fa-instagram fa-xl"></i></a></span>
                <span><a href="{{ $data->link_facebook }}" class="facebook pointer"><i class="fa-brands fa-facebook fa-xl"></i></a></span>
            </td>
            <td class="text-center">{{ $data->created_at }}</td>
            <td class="text-center">{{ $data->updated_at }}</td>
            <td>
                <a href="{{ route('branch.edit', ['id' => $data->id]) }}"><button><i class="fa-regular fa-pen-to-square"></i></button></a>
                <button id="delete-btn" onclick="deleteBranch('{{$data->id}}')"><i class="fa-solid fa-trash"></i></button>
            </td>

        </tr>

        @php $i++; @endphp
        @endforeach
    </table>

    <div class="pagination-container">
        <!-- Previous Page Link -->
        @if ($branch->onFirstPage())
        <div class="disabled" aria-disabled="true">
            <span>
                << </span>
        </div>
        <div class="disabled" aria-disabled="true">
            <span>
                < </span>
        </div>
        @else
        <div>
            <a href="{{ $branch->url(1) }}" rel="prev">
                << </a>
        </div>
        <div>
            <a href="{{ $branch->previousPageUrl() }}" rel="prev">
                < </a>
        </div>
        @endif

        @if($branch->lastPage() >= 5)
        <select class="page current-page" onchange="redirectToRoute(this.value, this, 'page')">
            @for ($i = 1; $i <= $branch->lastPage(); $i++)
                <option value="{{ $branch->url($i) }}" @if ($branch->currentPage() == $i) selected @endif>{{ $i }}</option>
                @endfor
        </select>
        @else
        @for ($i = 1; $i <= $branch->lastPage(); $i++)
            @if($i == $branch->currentPage())
            <div class="page current-page">{{$i}}</div>
            @else
            <div class="page"><a href="{{ $branch->url($i) }}">{{ $i }}</a></div>
            @endif
            @endfor
            @endif


            <!-- Next Page Link -->
            @if ($branch->hasMorePages())
            <div class="">
                <a href="{{ $branch->nextPageUrl() }}" rel="next">></a>
            </div>
            <div class="">
                <a href="{{ $branch->url($branch->lastPage()) }}" rel="prev">>></a>
            </div>
            @else
            <div class="disabled" aria-disabled="true">
                <span>></span>
            </div>
            <div class="disabled" aria-disabled="true">
                <span>>></span>
            </div>
            @endif
    </div>

    <div class="total text-center">
        <span>Showing {{ $branch->count() }} of {{ $branch->total() }} results</span>
    </div>
    <div id="preloader" class="text-center">
        <div class="spinner"></div>
    </div>
</div>



<script text="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const btnLocationDetail = document.getElementsByClassName('location-detail');
        const btnLocationDetailArr = Array.from(btnLocationDetail);

        btnLocationDetailArr.forEach(function(button, index) {
            button.addEventListener('click', function() {
                console.log(index);
                Swal.fire({
                    width: 500,
                    position: 'bottom-end',
                    toast: true,
                    showClass: {
                        popup: `
                            animate__animated
                            animate__fadeInRight
                            animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                            animate__animated
                            animate__fadeOutRight
                            animate__faster
                        `
                    },
                    template: "#my-template-" + (index + 1)
                });
            })
        });
    });

    // btnLocationDetail.addEventListener("click", function() {
</script>

@endsection

@section('activePage', 'branch')