@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/curriculum.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/curriculum.js') }}"></script>

<section class="curriculum">
    <h2 class="center" data-aos="fade-up">{!! __('messages.curriculum.main_title') !!}</h2>

    <div class="curriculum-wrapper">
        @foreach($curriculum as $data)
        <a href="https://www.google.com/search?q=wa+web&oq=wa&gs_lcrp=EgZjaHJvbWUqDggAEEUYJxg7GIAEGIoFMg4IABBFGCcYOxiABBiKBTINCAEQABiDARixAxiABDIGCAIQRRg7MgYIAxBFGDwyBggEEEUYPDIGCAUQRRg8MgYIBhBFGDwyBggHEAUYQNIBBzU0MGowajeoAgCwAgA&sourceid=chrome&ie=UTF-8"
            target="_blank">
            <div class="subject" data-aos="fade-up">
                <h2>{{ $data->curriculum_name}}</h2>
                <div class="curriculum-div">
                    <div class="img-curriculum">
                        <img src="{{ asset('images/database/curriculum/' . $data->image_path) }}">

                    </div>

                    <div class="price-curriculum">
                        <p class="price">Rp&nbsp;<span>{{$data->price}}</span>&nbsp;/{{
                            __('messages.curriculum.package.1.month')
                            }}</p>
                        <p class="center greentxt">{{ $data->duration }} {{ __('messages.curriculum.durationAll.drtAll') }} </p>
                    </div>
                </div>

                <div class="deskripsi">
                    <p><span class="redtxt">{{ $data->curriculum_name }}</span> &nbsp;{{ $data->description }}</p>
                </div>

                <div class="deskripsi">
                    {!! implode('', array_map(function($item) {
                    if ($item['type'] === 'paragraph') {
                    return $item['text'];
                    } elseif ($item['type'] === 'list') {
                    return '<ul>' . implode('', array_map(function($listItem) {
                        return '<li>' . strip_tags($listItem) . '</li>';
                        }, $item['items'])) . '</ul>';
                    }
                    }, $data->content)) !!}
                </div>
            </div>
        </a>
        @endforeach
    </div>

</section>