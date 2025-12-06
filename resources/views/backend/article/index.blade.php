@extends('backend.sidebar')

@section('content')

<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/main-content.css') }}" rel="stylesheet">
<link href="{{ mix('css/backend/table.css') }}" rel="stylesheet">

<div class="section-header">
    <h1>Article</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="main-content">
    <div class="controller-section">
        <div>
            <a href="{{ route('article.create') }}"><button><i class="fa-solid fa-circle-plus"></i>Add Article</button></a>
            <select id="dataPerPage" onchange="redirectToRoute(this.value, this, 'dataPerPage')">
                <option value="{{ route('article.index', ['data_per_page' => 10]) }}">10</option>
                <option value="{{ route('article.index', ['data_per_page' => 50]) }}">50</option>
                <option value="{{ route('article.index', ['data_per_page' => 100]) }}">100</option>
                <option value="{{ route('article.index', ['data_per_page' => 250]) }}">250</option>
                <option value="{{ route('article.index', ['data_per_page' => 500]) }}">500</option>
            </select>
        </div>

        <input id="search" placeholder="Search...">
    </div>
    <table id="table" data-json="{{ $article_data }}" data-page="article" data-totalpage="{{ $article->total() }}">
        <tr>
            <th>No. </th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Thumbnail</th>
            <th>Tag</th>
            <th><i class="fa-solid fa-star"></i></th>
            <th>Created At</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach($article as $data)
        <tr id="tes_{{ $data->id }}">
            <td>{{ $i }}</td>
            <td>{{ $data->judul }}</td>
            <td>{{ $data->penulis }}</td>
            <td>{{ $data->thumbnail }}</td>
            <td class="text-center">
                <template id="my-template-{{ $i }}">
                    <swal-html>
                        <h3>Tag Berita {{ $data->judul }}</h3>
                        <br>
                        @for ($j = 0; $j < count($data->tag); $j++)
                            <span class="attribute-modal">{{ $data->tag[$j]->detail->tag_name }}</span>
                            @endfor
                    </swal-html>
                    <swal-function-param name="showConfirmButton" value="false" />
                </template>
                <i id="tag-detail" class="fa-solid fa-tag tag-detail pointer"></i>
            </td>
            @if($data->highlighted == 0)
            <td class="text-center pointer"><i class="fa-solid fa-star highlighted" onclick="updateHighlight(this, '{{$data->id}}')" data-highlight="{{ $data->highlighted }}"></i></td>
            @else
            <td class="text-center pointer"><i class="fa-solid fa-star highlighted active" onclick="updateHighlight(this, '{{$data->id}}')" data-highlight="{{ $data->highlighted }}"></i></td>
            @endif
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                <a href="{{ route('article.edit', ['id' => $data->id]) }}"><button><i class="fa-regular fa-pen-to-square"></i></button></a>
                <button id="delete-btn" onclick="deleteArticle('{{$data->id}}')"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
    </table>

    <div class="pagination-container">
        <!-- Previous Page Link -->
        @if ($article->onFirstPage())
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
            <a href="{{ $article->url(1) }}" rel="prev">
                << </a>
        </div>
        <div>
            <a href="{{ $article->previousPageUrl() }}" rel="prev">
                < </a>
        </div>
        @endif

        @if($article->lastPage() >= 5)
        <select class="page current-page" onchange="redirectToRoute(this.value, this, 'page')">
            @for ($i = 1; $i <= $article->lastPage(); $i++)
                <option value="{{ $article->url($i) }}" @if ($article->currentPage() == $i) selected @endif>{{ $i }}</option>
                @endfor
        </select>
        @else
        @for ($i = 1; $i <= $article->lastPage(); $i++)
            @if($i == $article->currentPage())
            <div class="page current-page">{{$i}}</div>
            @else
            <div class="page"><a href="{{ $article->url($i) }}">{{ $i }}</a></div>
            @endif
            @endfor
            @endif


            <!-- Next Page Link -->
            @if ($article->hasMorePages())
            <div class="">
                <a href="{{ $article->nextPageUrl() }}" rel="next">></a>
            </div>
            <div class="">
                <a href="{{ $article->url($article->lastPage()) }}" rel="prev">>></a>
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
        <span>Showing {{ $article->count() }} of {{ $article->total() }} results</span>
    </div>
    <div id="preloader" class="text-center">
        <div class="spinner"></div>
    </div>
</div>

<script text="text/javascript">
    document.addEventListener("DOMContentLoaded", function setTagBtn() {
        const btnTagDetail = document.getElementsByClassName('tag-detail');
        const btnTagDetailArray = Array.from(btnTagDetail);

        btnTagDetailArray.forEach(function(button, index) {
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

    function updateHighlight(element, id) {
        var valueNow = element.dataset.highlight;
        var valueUpdate = 0;

        element.classList.toggle('load');
        console.log(valueNow);

        if (valueNow == 0 ? valueUpdate = 1 : null);

        fetchUpdate(valueUpdate, id)
            .then(data => {
                console.log("Data: ", data)
                if (data.status == "Success") {
                    element.classList.toggle('active');
                    element.dataset.highlight = data.value_update;
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: "Warning!",
                        text: "Already reach maximum highlighted article (max. 5)",
                        showConfirmButton: true,
                    });
                }

                element.classList.remove('load');

            })
            .catch(error => {
                console.log("Error outside async: ", error)
            });
    }

    async function fetchUpdate(value, id) {
        try {
            const response = await fetch('article/updateHighlight/' + id + '/' + value);

            if (!response.ok) {
                throw new Error('HTTP error! Status: ' + response.json());
            }

            const data = await response.json();
            return data
        } catch (error) {
            console.error('Error inside async:', error);
            return error
        }
    }
</script>

@endsection

@section('activePage', 'article')