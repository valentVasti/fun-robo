@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/table.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Curriculum</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <div class="controller-section">
        <div>
            <a href="{{ route('curriculum.create') }}"><button><i class="fa-solid fa-circle-plus"></i>Add curriculum</button></a>
            <select id="dataPerPage" onchange="redirectToRoute(this.value, this, 'dataPerPage')">
                <option value="{{ route('curriculum.index', ['data_per_page' => 10]) }}">10</option>
                <option value="{{ route('curriculum.index', ['data_per_page' => 50]) }}">50</option>
                <option value="{{ route('curriculum.index', ['data_per_page' => 100]) }}">100</option>
                <option value="{{ route('curriculum.index', ['data_per_page' => 250]) }}">250</option>
                <option value="{{ route('curriculum.index', ['data_per_page' => 500]) }}">500</option>
            </select>
        </div>

        <input id="search" placeholder="Search...">
    </div>

    <table id="table" data-json="{{ $curriculum_data }}" data-page="curriculum" data-totalpage="{{ $curriculum->total() }}">
        <tr>
            <th>No. </th>
            <th>Curriculum Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Age (Min.)</th>
            <th>Age (Max.)</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach($curriculum as $data)
        <tr id="{{ $data->id }}">
            <td>{{ $i }}</td>
            <td>{{ $data->curriculum_name }}</td>
            <td>{{ $data->price }}</td>
            <td>{{ $data->duration }}</td>
            <td>{{ $data->age_min }}</td>
            <td>{{ $data->age_max }}</td>
            <td>{{ $data->description }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                <a href="{{ route('curriculum.edit', ['id' => $data->id]) }}"><button><i class="fa-regular fa-pen-to-square"></i></button></a>
                <button id="delete-btn" onclick="deleteCurriculum('{{$data->id}}')"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
    </table>

    <div class="pagination-container">
        <!-- Previous Page Link -->
        @if ($curriculum->onFirstPage())
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
            <a href="{{ $curriculum->url(1) }}" rel="prev">
                << </a>
        </div>
        <div>
            <a href="{{ $curriculum->previousPageUrl() }}" rel="prev">
                < </a>
        </div>
        @endif

        @if($curriculum->lastPage() >= 5)
        <select class="page current-page" onchange="redirectToRoute(this.value, this, 'page')">
            @for ($i = 1; $i <= $curriculum->lastPage(); $i++)
                <option value="{{ $curriculum->url($i) }}" @if ($curriculum->currentPage() == $i) selected @endif>{{ $i }}</option>
                @endfor
        </select>
        @else
        @for ($i = 1; $i <= $curriculum->lastPage(); $i++)
            @if($i == $curriculum->currentPage())
            <div class="page current-page">{{$i}}</div>
            @else
            <div class="page"><a href="{{ $curriculum->url($i) }}">{{ $i }}</a></div>
            @endif
            @endfor
            @endif


            <!-- Next Page Link -->
            @if ($curriculum->hasMorePages())
            <div class="">
                <a href="{{ $curriculum->nextPageUrl() }}" rel="next">></a>
            </div>
            <div class="">
                <a href="{{ $curriculum->url($curriculum->lastPage()) }}" rel="prev">>></a>
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
        <span>Showing {{ $curriculum->count() }} of {{ $curriculum->total() }} results</span>
    </div>
    <div id="preloader" class="text-center">
        <div class="spinner"></div>
    </div>
</div>

@endsection

@section('activePage', 'curriculum')