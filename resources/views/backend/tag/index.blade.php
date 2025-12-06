@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/table.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Tag</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <div class="controller-section">
        <div>
            <a href="{{ route('tag.create') }}"><button><i class="fa-solid fa-circle-plus"></i>Add tag</button></a>
            <select id="dataPerPage" onchange="redirectToRoute(this.value, this, 'dataPerPage')">
                <option value="{{ route('tag.index', ['data_per_page' => 10]) }}">10</option>
                <option value="{{ route('tag.index', ['data_per_page' => 50]) }}">50</option>
                <option value="{{ route('tag.index', ['data_per_page' => 100]) }}">100</option>
                <option value="{{ route('tag.index', ['data_per_page' => 250]) }}">250</option>
                <option value="{{ route('tag.index', ['data_per_page' => 500]) }}">500</option>
            </select>
        </div>

        <input id="search" placeholder="Search...">
    </div>

    <table id="table" data-json="{{ $tag_data }}" data-page="tag" data-totalpage="{{ $tag->total() }}">
        <tr>
            <th>No. </th>
            <th>Tag Name</th>
            <th>Created At</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach($tag as $data)
        <tr id="{{ $data->id }}">
            <td>{{ $i }}</td>
            <td>{{ $data->tag_name }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                <a href="{{ route('tag.edit', ['id' => $data->id]) }}"><button><i class="fa-regular fa-pen-to-square"></i></button></a>
                <button id="delete-btn" onclick="deleteTag('{{$data->id}}')"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
    </table>

    <div class="pagination-container">
        <!-- Previous Page Link -->
        @if ($tag->onFirstPage())
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
            <a href="{{ $tag->url(1) }}" rel="prev">
                << </a>
        </div>
        <div>
            <a href="{{ $tag->previousPageUrl() }}" rel="prev">
                < </a>
        </div>
        @endif

        @if($tag->lastPage() >= 5)
        <select class="page current-page" onchange="redirectToRoute(this.value, this, 'page')">
            @for ($i = 1; $i <= $tag->lastPage(); $i++)
                <option value="{{ $tag->url($i) }}" @if ($tag->currentPage() == $i) selected @endif>{{ $i }}</option>
                @endfor
        </select>
        @else
        @for ($i = 1; $i <= $tag->lastPage(); $i++)
            @if($i == $tag->currentPage())
            <div class="page current-page">{{$i}}</div>
            @else
            <div class="page"><a href="{{ $tag->url($i) }}">{{ $i }}</a></div>
            @endif
            @endfor
            @endif


            <!-- Next Page Link -->
            @if ($tag->hasMorePages())
            <div class="">
                <a href="{{ $tag->nextPageUrl() }}" rel="next">></a>
            </div>
            <div class="">
                <a href="{{ $tag->url($tag->lastPage()) }}" rel="prev">>></a>
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
        <span>Showing {{ $tag->count() }} of {{ $tag->total() }} results</span>
    </div>
    <div id="preloader" class="text-center">
        <div class="spinner"></div>
    </div>
</div>

@endsection

@section('activePage', 'tag')