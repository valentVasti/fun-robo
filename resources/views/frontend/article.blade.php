@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/articles.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/article.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<section class="article" >
    <!-- artikel utama -->
    <div class="main-article-container" data-aos="fade-up">
        <div class="main-article-div" data-content-before="{{ __('messages.article.newest_title') }}">
            <div class="main-img-div">
                <img src="{{  asset('images/database/article/' . $newestArticle->thumbnail) }}" alt="test">
            </div>
            <div class="main-description">
                <h3>{{ $newestArticle->judul }} </h3>
                <p class="redtxt">{{ $newestArticle->tag[0]->detail->tag_name }}</p>
                <p class="gray">{{ $newestArticle->isi}}</p>
                <a target="_blank" href="{{ route('frontend.articleDetail', ['locale' => app()->getLocale(), 'id' => $newestArticle->id]) }}"><button class="unique-button green ">Lihat Detail</button></a>
                <div class="datetime gray">
                    <p>{{ $newestArticle->created_at->format('l, d F Y') }}</p>
                    <p>{{ $newestArticle->created_at->format('H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="popular-article-div" data-content-before="{{ __('messages.article.popular_title') }}">
            <div class="popular-article-container">
                @foreach($popularArticle as $data)
                <a target="_blank" href="{{ route('frontend.articleDetail', ['locale' => app()->getLocale(), 'id' => $data->id]) }}">
                    <div class="popular-img-div">
                        <img src="{{ asset('images/database/article/' . $data->thumbnail) }}" alt="test">
                    </div>
                    <div class="popular-desc-div">
                        <h3>{{ $data->judul }}</h3>
                        <p class="redtxt">{{ $data->tag ? $data->tag->first()->detail->tag_name : '' }}</p>
                    </div>
                </a>
                @endforeach
                <a href="#category-title"><button class="unique-button green ">Lihat Semua</button></a>
            </div>
        </div>
    </div>

    <!-- Artikel - artikel -->
    <div id="category-title" class="category-title">
        <h3>{{ __('messages.article.category_title') }}</h3>
    </div>

    <div class="wrapper">
        <div class="icon"><i id="left" class="fa-solid fa-angle-left"></i></div>
        <ul class="tabs-box" id="tabs">
            <li class="tab active" onclick="showArticles('All Kategori')">All Kategori</li>
            @foreach($tag as $tags)
            <li class="tab" onclick="showArticles('{{$tags->id}}', '{{ app()->getLocale() }}')">{{$tags->tag_name}}</li>
            @endforeach
        </ul>
        <div class="icon"><i id="right" class="fa-solid fa-angle-right"></i></div>
    </div>
    <div class="article-wrapper" id="article-wrapper"   data-json='{{ json_encode($article) }}'
        >
        @foreach($article as $data)
        <div class="article-container">
            <div class="img-wrapper">
                <img src="{{ asset('images/database/article/' . $data->thumbnail) }} ">
            </div>
            <div class="description-wrapper">
                <p class="redtxt">{{ $data->tag->first() ? $data->tag->first()->detail->tag_name : '' }}</p>
                <h3>{{ $data->judul }}</h3>
                <p class="gray">{{ $data->isi }}</p>
                <a  href="{{ route('frontend.articleDetail', ['locale' => app()->getLocale(), 'id' => $data->id]) }}" target="_blank"><button class="unique-button green">Lihat Detail</button></a>
                <div class="datetime gray">
                    <p>{{ $data->created_at->format('l, d F Y') }}</p>
                    <p>{{ $data->created_at->format('H:i') }}</p>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</section>

