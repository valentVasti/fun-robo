@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/table.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Awards</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <div class="controller-section">
        <div>
            <a href="{{ route('awards.create') }}"><button><i class="fa-solid fa-circle-plus"></i>Add Awards</button></a>
            <select id="dataPerPage" onchange="redirectToRoute(this.value, this, 'dataPerPage')">
                <option value="{{ route('awards.index', ['data_per_page' => 10]) }}">10</option>
                <option value="{{ route('awards.index', ['data_per_page' => 50]) }}">50</option>
                <option value="{{ route('awards.index', ['data_per_page' => 100]) }}">100</option>
                <option value="{{ route('awards.index', ['data_per_page' => 250]) }}">250</option>
                <option value="{{ route('awards.index', ['data_per_page' => 500]) }}">500</option>
            </select>
        </div>

        <input id="search" placeholder="Search...">
    </div>

    <table id="table" data-json="{{ $awards_data }}" data-page="awards" data-totalpage="{{ $awards->total() }}">
        <tr>
            <th>No. </th>
            <th>Achievements</th>
            <th>Event</th>
            <th>Year</th>
            <th>Place</th>
            <th>Type</th>
            <th>Created At</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach($awards as $data)
        <tr id="{{ $data->id }}">
            <td>{{ $i }}</td>
            <td>{{ $data->achievement }}</td>
            <td>{{ $data->event }}</td>
            <td>{{ $data->year }}</td>
            <td>{{ $data->place }}</td>
            <td>{{ $data->type }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                <a href="{{ route('awards.edit', ['id' => $data->id]) }}"><button><i class="fa-regular fa-pen-to-square"></i></button></a>
                <button id="delete-btn" onclick="deleteAwards('{{$data->id}}')"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
    </table>

    <div class="pagination-container">
        <!-- Previous Page Link -->
        @if ($awards->onFirstPage())
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
            <a href="{{ $awards->url(1) }}" rel="prev">
                << </a>
        </div>
        <div>
            <a href="{{ $awards->previousPageUrl() }}" rel="prev">
                < </a>
        </div>
        @endif

        @if($awards->lastPage() >= 5)
        <select class="page current-page" onchange="redirectToRoute(this.value, this, 'page')">
            @for ($i = 1; $i <= $awards->lastPage(); $i++)
                <option value="{{ $awards->url($i) }}" @if ($awards->currentPage() == $i) selected @endif>{{ $i }}</option>
                @endfor
        </select>
        @else
        @for ($i = 1; $i <= $awards->lastPage(); $i++)
            @if($i == $awards->currentPage())
            <div class="page current-page">{{$i}}</div>
            @else
            <div class="page"><a href="{{ $awards->url($i) }}">{{ $i }}</a></div>
            @endif
            @endfor
            @endif


            <!-- Next Page Link -->
            @if ($awards->hasMorePages())
            <div class="">
                <a href="{{ $awards->nextPageUrl() }}" rel="next">></a>
            </div>
            <div class="">
                <a href="{{ $awards->url($awards->lastPage()) }}" rel="prev">>></a>
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
        <span>Showing {{ $awards->count() }} of {{ $awards->total() }} results</span>
    </div>
    <div id="preloader" class="text-center">
        <div class="spinner"></div>
    </div>
</div>

@endsection

@section('activePage', 'awards')