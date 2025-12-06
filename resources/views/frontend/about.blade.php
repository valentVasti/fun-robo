@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/about.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/about.js') }}"></script>


<section class="about-landing-section">
    <div id="landing-image" class="about-landing" onclick="setLandingImage(this)" data-landing="{{ asset('images/database/aboutUs/' . $landingImageContent) }}" data-aos="fade-up">
        <div class="box" data-aos="fade-up">
            <h2>{!! $shortTextContent !!}</h2>
            <a href="#about-section"><button class="unique-button">{{ __('messages.view_detail') }}</button></a>
        </div>
    </div>

    <script type="text/javascript">
        const landingImageElement = document.getElementById('landing-image');
        landingImageElement.style.backgroundImage = "url(" + landingImageElement.dataset.landing + ")";
    </script>
</section>

<section id="about-section" class="about">
    <div class="about-container">
        <div class="content" data-aos="fade-up">
            <h3 class="center">{!! __('messages.about_us.detailSection.mascot_title') !!}</h3>
            <div class="mascot-container">
                <img src="{{ asset('images/database/aboutUs/' . $mascot1Content) }}">
                <img src="{{ asset('images/database/aboutUs/' . $mascot2Content) }}">
            </div>
        </div>

        <div class="content" data-aos="fade-up">
            <h3 class="center">{!! __('messages.about_us.detailSection.about_title') !!}</h3>
            {!! $longTextContent !!}
        </div>

        <div class="content" data-aos="fade-up">
            <h3 class="center">{!! __('messages.about_us.detailSection.office_title') !!}</h3>
            <div class="img-wrapper">
                <img src="{{ asset('images/database/aboutUs/' . $image1Content) }}">
            </div>
            <div class="img-wrapper">
                <img src="{{ asset('images/database/aboutUs/' . $image2Content) }}">
            </div>
        </div>
    </div>
</section>