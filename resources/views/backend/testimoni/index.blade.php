@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/table.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Testimoni</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <div class="controller-section">
        <div>
            <a href="{{ route('testimoni.create') }}"><button><i class="fa-solid fa-circle-plus"></i>Add testimoni</button></a>
            <select id="dataPerPage" onchange="redirectToRoute(this.value, this, 'dataPerPage')">
                <option value="{{ route('testimoni.index', ['data_per_page' => 10]) }}">10</option>
                <option value="{{ route('testimoni.index', ['data_per_page' => 50]) }}">50</option>
                <option value="{{ route('testimoni.index', ['data_per_page' => 100]) }}">100</option>
                <option value="{{ route('testimoni.index', ['data_per_page' => 250]) }}">250</option>
                <option value="{{ route('testimoni.index', ['data_per_page' => 500]) }}">500</option>
            </select>
        </div>

        <input id="search" placeholder="Search...">
    </div>

    <table id="table" data-json="{{ $testimoni_data }}" data-page="testimoni" data-totalpage="{{ $testimoni->total() }}">
        <tr>
            <th>No. </th>
            <th>Testimonee</th>
            <th>Keterangan</th>
            <th>Umur</th>
            <th>Isi Testimoni</th>
            <th>Created At</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach($testimoni as $data)
        <tr id="{{ $data->id }}">
            <td>{{ $i }}</td>
            <td>{{ $data->nama_testimoni }}</td>
            <td>{{ $data->keterangan_testimoni }}</td>
            <td>{{ $data->umur_testimoni }}</td>
            <td>{{ $data->isi_testimoni }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                <a href="{{ route('testimoni.edit', ['id' => $data->id]) }}"><button><i class="fa-regular fa-pen-to-square"></i></button></a>
                <button id="delete-btn" onclick="deleteTestimoni('{{$data->id}}')"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
    </table>

    <div class="pagination-container">
        <!-- Previous Page Link -->
        @if ($testimoni->onFirstPage())
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
            <a href="{{ $testimoni->url(1) }}" rel="prev">
                << </a>
        </div>
        <div>
            <a href="{{ $testimoni->previousPageUrl() }}" rel="prev">
                < </a>
        </div>
        @endif

        @if($testimoni->lastPage() >= 5)
        <select class="page current-page" onchange="redirectToRoute(this.value, this, 'page')">
            @for ($i = 1; $i <= $testimoni->lastPage(); $i++)
                <option value="{{ $testimoni->url($i) }}" @if ($testimoni->currentPage() == $i) selected @endif>{{ $i }}</option>
                @endfor
        </select>
        @else
        @for ($i = 1; $i <= $testimoni->lastPage(); $i++)
            @if($i == $testimoni->currentPage())
            <div class="page current-page">{{$i}}</div>
            @else
            <div class="page"><a href="{{ $testimoni->url($i) }}">{{ $i }}</a></div>
            @endif
            @endfor
            @endif


            <!-- Next Page Link -->
            @if ($testimoni->hasMorePages())
            <div class="">
                <a href="{{ $testimoni->nextPageUrl() }}" rel="next">></a>
            </div>
            <div class="">
                <a href="{{ $testimoni->url($testimoni->lastPage()) }}" rel="prev">>></a>
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
        <span>Showing {{ $testimoni->count() }} of {{ $testimoni->total() }} results</span>
    </div>
    <div id="preloader" class="text-center">
        <div class="spinner"></div>
    </div>
</div>

@endsection

@section('activePage', 'testimoni')