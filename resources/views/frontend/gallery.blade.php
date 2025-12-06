@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/gallery.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/gallery.js') }}"></script>

    <section class="gallery"data-aos="fade-up">
        <h2 class="center" ><span class="redtxt">FunRobo</span><span  class="greentxt">&nbsp;Gallery</span></h2>
        <div class="gallery-container" >
            @foreach($filesArr as $data)
            <div class="gallery-wrapper">
                <img src="{{ asset('images/database/'.$data) }}" alt="FunRobo">
            </div>
            @endforeach
        </div>
    </section>

