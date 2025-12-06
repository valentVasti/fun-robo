@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/testimoni.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/testimoni.js') }}"></script>

<section class="testimoni">
    <h2 class="center" data-aos="fade-up"><span class="redtxt">FunRobo</span><span  class="greentxt">&nbsp;Testimoni</span></h2>

    <div class="testimoni-wrapper">
        @foreach($testimoni as $data)
        <div class="testimoni-card" data-aos="fade-up">
            <div class="img-wrapper">
                <img src="{{ asset('images/database/testimoni/' . $data->gambar_testimoni) }}" alt="FunRobo">
            </div>
            <div class="desc-wrapper">
                <h2 class="nama-testimoni">{{ $data->nama_testimoni }}</h2>
                <p class="umur-keterangan">{{ $data->keterangan_testimoni }}</p>
                <p class="isi">{{ $data->isi_testimoni }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>