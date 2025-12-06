@extends('frontend.master')
@section('content')

<!-- CSS -->
<link href="{{ mix('css/frontend/home.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

<!-- JS -->
<script src="{{ mix('js/home.js') }}"></script>

<section class="landing-page1" data-aos="fade-up" data-aos-duration="1000">
  <div class="img-wrapper1">
    <img src="{{ asset('images/others/landing_img.png') }}" alt="FunRobo">
  </div>
  <div class="lp-description1">
    <img src="{{ asset('images/logo/Logo_1.png') }}" alt="FunRobo">
    <h2 class="title">{{ __('messages.home.landingSection.title') }}</h2>
    <h2>{{ __('messages.home.landingSection.text') }}</h2>
    <a href=" https://www.youtube.com/@roboticsjogja441" target="_blank"><button class="unique-button red">YouTube</button></a>
    <a href="{{ 'https://wa.me/'.$main_kontak->phone_num }}" target="_blank"><button class="unique-button green">WhatsApp</button></a>
  </div>
</section>

<section class="about-us" data-aos="fade-right" data-aos-duration="1000">
  <div class="about-wrapper">
    <div class="about-img-wrapper">
      <div class="about-counter">
        <img src="{{ asset('images/others/about_us_img.JPG') }}" alt="FunRobo">
      </div>
      <div class="fa-solid fa-gear gear-spin"></div>
    </div>
    <div class="about-description">
      <h2>{{ __('messages.home.aboutSection.title') }}</h2>
      <h3>{!! $about->content !!}</h3>
      <a href="{{ route('frontend.about', ['locale' => app()->getLocale()]) }}" target="_blank"><button class="unique-button red">{{ __('messages.view_detail') }}</button></a>
    </div>
  </div>
</section>

<section class="why-us" data-aos="fade-left" data-aos-duration="1000">
  <div class="why-us-wrapper">
    <div class="why-description">
      <h2>{{ __('messages.home.whyUsSection.title') }}</h2>
      <h3>
        <ul>
          <li>{{ __('messages.home.whyUsSection.1') }}</li>
          <li>{{ __('messages.home.whyUsSection.2') }}</li>
          <li>{{ __('messages.home.whyUsSection.3') }}</li>
          <li>{{ __('messages.home.whyUsSection.4') }}</li>
        </ul>
      </h3>
      <a href="{{ route('frontend.about', ['locale' => app()->getLocale()]) }}" target="_blank"><button class="unique-button green">{{ __('messages.view_detail') }}</button></a>
    </div>
    <div class="why-img-wrapper">
      <div class="why-counter">
        <img src="{{ asset('images/others/why_us_img.JPG') }}" alt="FunRobo">
      </div>
      <div class="fa-solid fa-gear gear-spin"></div>
    </div>
  </div>
</section>

<section class="benefit">
  <h2 class="title">{{ __('messages.home.benefitSection.title') }}</h2>
  <img class="section-image" src="{{ asset('images/mascot/Fani02.png') }}" alt="FunRobo">

  <div class="benefit-wrapper">
    @foreach($benefit as $data)
    <div class="benefit-card" data-aos="fade-up">
      <div class="img-benefit">
        <img src="{{ asset('images/mascot/' . $data->mascot_path) }}" alt="">
      </div>
      <div class="desc-benefit">
        <hr class="line-break">
        <p>{{ $data->benefit }}</p>
      </div>
    </div>
    @endforeach
  </div>

</section>

<section class="curriculum">
  <h2 class="title">{{ __('messages.home.curriculumSection.title') }}</h2>
  <img class="section-image" src="{{ asset('images/mascot/Robi05.png') }}" alt="FunRobo">

  <div class="curriculum-wrapper">
    @foreach($curriculum as $data)
    <a href="{{ route('frontend.curriculum', ['locale' => app()->getLocale()]) }}" target="_blank">
      <div class="curriculum-card" data-aos="fade-up">
        <div class="img-curriculum">
          <img src="{{ asset('images/database/curriculum/' . $data->image_path) }}" alt="">
        </div>
        <div class="desc-curriculum">
          <hr class="line-break">
          <p class="curriculum-subject">{{ $data->curriculum_name }}</p>
          @if($data->age_max != null)
          <p>{{ __('messages.home.curriculumSection.age_text') }}&nbsp;{{ $data->age_min }} - {{ $data->age_max }}&nbsp;{{ __('messages.home.curriculumSection.years') }}</p>
          @else
          <p>{{ $data->age_min }}&nbsp;{{ __('messages.home.curriculumSection.years') }}&nbsp;{{ __('messages.home.curriculumSection.above') }}</p>
          @endif
        </div>
      </div>
    </a>
    @endforeach
  </div>

</section>

<section class="quotes" data-aos="fade-up" data-aos-duration="1000">
  <div class="curriculum-quotes">
    <div class="quotes-wrapper">
      <p>{{ __('messages.home.quotesSection.quotes') }}</p>
      <h2>{{ __('messages.home.quotesSection.text') }}</h2>
      <a href="{{ route('frontend.branch', ['locale' => app()->getLocale()])  }}" target="_blank"><button class="unique-button green">{{ __('messages.home.quotesSection.contact_us') }}</button></a>
      <div class="cirlce-frame">
        <div class="circle-img-wrapper">
          <div class="second-circle-img-wrapper">
            <img src="{{ asset('images/others/join-us.png') }}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="awards2">
  <h2 class="title">{{ __('messages.home.awardsSection.title') }}</h2>
  <img class="section-image" src="{{ asset('images/mascot/Robi06.png') }}" alt="" class="awards-mascot">

  <div class="award-slick-div">
    <ul class="home-slick">
      @foreach($awards as $award)
      <li>
        <div class="awards-container">
          <h3 class="awards-category">{{ $award->type }}</h3>
          <div class="awards-main-div">
            <div class="awards-compete-div">
              <h3 class="awards-compete">{{ $award->event }} {{ $award->place }} {{ $award->year }}</h3>
              <h3 class="awards-comepete-ket">{{ $award->achievement }}</h3>
            </div>
            <div class="awards-img-div">
              <div class="awards-img-container">
                <img src="{{ asset('images/database/awards/' . ($award->img->first() ? $award->img->first()->path : '')) }}" alt="FunRobo">
              </div>
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="center">
    <a href="{{ route('frontend.awards', ['locale' => app()->getLocale()]) }}" target="_blank"><button class="unique-button green ">{{ __('messages.view_detail') }}</button></a>
  </div>
</section>

<section class="testimoni" data-aos="fade-up" data-aos-duration="1000">
  <h2 class="title">{{ __('messages.home.testimoniSection.title') }}</h2>
  <img class="section-image" src="{{ asset('images/mascot/Fani05.png') }}" alt="" class="awards-mascot">

  <div class="testi-slick-div">
    <ul class="home-slick">
      @foreach($testimoni as $data)
      <li>
        <div class="testimoni-wrapper">
          <div class="testimoni-card">
            <div class="testi-img-wrapper">
              <img src="{{ asset('images/database/testimoni/' . $data->gambar_testimoni) }}" alt="FunRobo">
            </div>
            <div class="desc-wrapper">
              <h2 class="nama-testimoni">{{ $data->nama_testimoni }}</h2>
              <p class="umur-keterangan">{{ $data->keterangan_testimoni }}</p>
              <p class="isi">{{ $data->isi_testimoni }}</p>
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="center">
    <a href="{{ route('frontend.testimoni', ['locale' => app()->getLocale()]) }}" target="_blank"><button class="unique-button red ">{{ __('messages.view_detail') }}</button></a>
  </div>
</section>

<section class="article" data-aos="fade-up" data-aos-duration="1000">
  <h2 class="title">{{ __('messages.home.articleSection.title') }}</h2>
  <img class="section-image" src="{{ asset('images/mascot/Robi03.png') }}" alt="" class="awards-mascot">

  <div class="testi-slick-div">
    <ul class="home-slick">
      @foreach($popularArticle as $data)
      <li>

        <div class="article-container">
          <div class="article-img-wrapper">
            <img src="{{ asset('images/database/article/' . $data->thumbnail) }} ">
          </div>
          <div class="description-wrapper">
            <p class="redtxt">AAA</p>
            <h3>{{ $data->judul }}</h3>
            <p class="gray">{{ $data->isi }}</p>
            <a href="{{ route('frontend.articleDetail', ['locale' => app()->getLocale(), 'id' => $data->id]) }}" target="_blank"><button class="unique-button green">{{ __('messages.view_detail') }}</button></a>
            <div class="datetime gray">
              <p>{{ $data->created_at->format('l, d F Y') }}</p>
              <p>{{ $data->created_at->format('H:i') }}</p>
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="center">
    <a href="{{ route('frontend.article', ['locale' => app()->getLocale()]) }}" target="_blank"><button class="unique-button green ">{{ __('messages.view_detail') }}</button></a>
  </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>