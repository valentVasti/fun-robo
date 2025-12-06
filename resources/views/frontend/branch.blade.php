@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/branch.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/branch.js') }}"></script>

<section class="contact">
    <h2 class="center" data-aos="fade-up">{!! __('messages.contact.title') !!}</h2>

    <div class="branch-wrapper">
        @foreach($branch as $data)
        <div class="branch" data-aos="fade-up" data-aos-duration="700">
            <h3 class="branch-name">{{ $data->nama_branch }}</h3>

            <div class="description">
                <img src="{{ asset('images/database/branch/' . $data->gambar_branch) }}" alt="">
                <div class="googlemaps">
                    <iframe src="{{ $data->link_gmaps }}" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="red-caption">
                <h3 class="address">{{ $data->alamat }}, {{ $data->kota }}, {{ $data->provinsi }} </h3>
                <div class="branch-socmed">
                    <a href="https://wa.me/{{ $data->phone_num }}" target="_blank">
                        <h3><span class="fa fa-whatsapp" style="font-size:1.3rem;color: green;"></span>&nbsp; {{ $data->phone_num }}</h3>
                    </a>
                    <a href="{{ $data->link_instagram }}" target="_blank">
                        <h3><span class="fa fa-instagram" style="font-size:1.3rem;color: red;"></span>&nbsp; {{ $data->instagram }}</h3>
                    </a>
                    <a>
                        <h3><span class="fa fa-envelope" style="font-size:1.3rem;color: blue;"></span>&nbsp; {{ $data->email }}</h3>
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="contact-wrapper">
            <a href="{{ 'https://wa.me/'.$main_kontak->phone_num }}" target="_blank" data-aos="fade-up" data-aos-duration="700">
                <div class="media-wrapper whatsapp">
                    <i href="{{ 'https://wa.me/'.$main_kontak->phone_num }}" target="_blank" class="fa fa-whatsapp"></i>
                    <h2>Whatsapp</h2>
                    <h2>{{ $main_kontak->phone_num }}</h2>
                </div>
            </a>

            <a href="https://www.instagram.com/roboticsjogja" target="_blank" data-aos="fade-up" data-aos-duration="700">
                <div class="media-wrapper instagram">
                    <i href="{{ $main_kontak->link_instagram }}" target="_blank" class="fa fa-instagram"></i>
                    <h2>Instagram</h2>
                    <h2>{{ $main_kontak->instagram }}</h2>
                </div>
            </a>

            <a href="https://www.facebook.com/profile.php?id=100015448592361" target="_blank" data-aos="fade-up" data-aos-duration="700">
                <div class="media-wrapper facebook">
                    <i href="{{ $main_kontak->link_facebook }}" target="_blank" class="fa fa-facebook"></i>
                    <h2>Facebook</h2>
                    <h2>{{ $main_kontak->facebook }}</h2>
                </div>
            </a>
        </div>
</section>