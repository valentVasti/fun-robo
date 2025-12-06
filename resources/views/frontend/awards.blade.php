@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/awards.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/award.js') }}"></script>


<section class="awards-section">
    <h2 class="center" data-aos="fade-up">{!! __('messages.awards.title') !!}</h2>

    @foreach($awards as $award)
    <div class="awards-container" data-aos="fade-up">
        <h3 class="awards-category">{{ $award->type }}</h3>
        <div class="awards-main-div">
            <div class="awards-compete-div">
                <h3 class="awards-compete">{{ $award->event }} {{ $award->place }} {{ $award->year }}</h3>
                <h3 class="awards-comepete-ket">{{ $award->achievement }}</h3>
            </div>
            <div class="awards-img-div">
                @foreach($award->img as $image)
                    <div class="awards-img-container">
                        <img src="{{ asset('images/database/awards/' . $image->path) }}" alt="FunRobo">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach


    </div>

</section>