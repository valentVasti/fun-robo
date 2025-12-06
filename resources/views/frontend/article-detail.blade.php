@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/article-detail.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/article-detail.js') }}"></script>

<section class="article-detail" data-aos="fade-up" data-aos-duration="1000">
    
    <article>
        <div class="title">
            <h3>{{ $article->judul }}</h3>
            <p>{{ $article->penulis }}</p>
            <div class="datetime">
                <p>{{ $article->created_at->format('l, d F Y') }}</p>
                <p>{{ $article->created_at->format('H:i') }}</p>
            </div>
        </div>

        <figure>
            <img src="{{ asset('images/database/article/'.$article->thumbnail) }}" alt="FunRobo">
            <figcaption>{{ $article->thumbnail_caption }}</figcaption>
        </figure>

        <p>{!! $article->isi !!}</p>
    </article>

    <div class="popular-article-div" data-content-before="{{ __('messages.article.popular_title') }}">
        <div class="popular-article-container">
            @foreach($popularArticle as $data)
            <a target="_blank" href="{{ route('frontend.articleDetail', ['locale' => app()->getLocale(), 'id' => $data->id]) }}">
                <div class="popular-img-div">
                    <img src="{{ asset('images/database/article/' . $data->thumbnail) }}" alt="test">
                </div>
                <div class="popular-desc-div">
                    <h3>{{ $data->judul }}</h3>
                    <p class="redtxt">{{ $data->tag->first() ? $data->tag->first()->detail->tag_name : '' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>