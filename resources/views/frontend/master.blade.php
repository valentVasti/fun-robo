<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content=""/>
        <meta name="author" content=""/>

        <title>FunRobo | {{ $title }} | {{ strtoupper(app()->getLocale()) }}</title>

        <!-- CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="{{ mix('css/frontend/master.css') }}" rel="stylesheet">
        <link href="{{ asset('css/color.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font.css') }}" rel="stylesheet">

        <!-- JS -->
        <script src="{{ mix('js/navbar.js') }}"></script>
        <script src="{{ mix('js/preloader.js') }}"></script>

        <!-- Font-Awesome -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

        <!-- script -->
        <script src="https://kit.fontawesome.com/21dacd436b.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>

    <body>
        <div id="preloader">
            <div class="spinner"></div>
        </div>

        <header>
            <nav class="navbar-wrapper">
                <div class="icon-wrapper"><a href="{{ route('frontend.home', ['locale' => app()->getLocale()]) }}"><img src="{{ asset('images/logo/Logo_5.png') }}" alt="FunRobo"></a></div>
                <div class="icon-wrapper"><a href="/"><img src="{{ asset('images/logo/logo_9.png') }}" alt="FunRobo"></a></div>
                <div class="menu-wrapper">
                    <div class="menu-toggle" id="menuToggle">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                    <ul>
                        <li><a class ="underline" href="{{ route('frontend.about', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.about_us') }}</a></li>
                        <li><a class ="underline" href="{{ route('frontend.curriculum', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.curriculum') }}</a></li>
                        <li><a class ="underline" href="{{ route('frontend.article', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.article') }}</a></li>
                        <li><a class ="underline" href="{{ route('frontend.awards', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.awards') }}</a></li>
                        <li><a class ="underline" href="{{ route('frontend.branch', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.contact') }}</a></li>
                        <li><a class ="underline" href="{{ route('frontend.gallery', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.gallery') }}</a></li>
                        <div><button id="translateButton" data-language="id">ID  EN</button></div>
                        
                    </ul>
                </div>
            </nav>
        </header>

        @yield('content')
        <footer>
            <nav class="footer-wrapper" data-aos="fade-up" data-aos-duration="1000">
                <div class="footer-second-wrapper">
                    <div class="footer-menu">
                        <a href="{{ route('frontend.home' , ['locale' => app()->getLocale()]) }}"><img class="img-footer" src="{{ asset('images/logo/Logo_5.png') }}" alt="FunRobo"></a>
                        <div class="social-media">
                            <h2>Social Media</h2>
                            <ul>
                                <li><a href="{{ $main_kontak->link_facebook }}" target="_blank" class="fa fa-facebook"></a></li>
                                <li><a href="{{ $main_kontak->link_instagram }}" target="_blank" class="fa fa-instagram"></a></li>
                                <li><a href="{{ 'https://wa.me/'.$main_kontak->phone_num }}" target="_blank" class="fa fa-whatsapp"></a></li>
                            </ul>
                        </div>    
                    </div>
                    <div class="footer-menu">
                        <h2>Navigation</h2>
                        <ul class="footer-link">
                            <li><a class ="underline" href="{{ route('frontend.about', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.about_us') }}</a></li>
                            <li><a class ="underline" href="{{ route('frontend.curriculum', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.curriculum') }}</a></li>
                            <li><a class ="underline" href="{{ route('frontend.article', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.article') }}</a></li>
                            <li><a class ="underline" href="{{ route('frontend.awards', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.awards') }}</a></li>
                            <li><a class ="underline" href="{{ route('frontend.branch', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.branch') }}</a></li>
                            <li><a class ="underline" href="{{ route('frontend.gallery', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.navbar.gallery') }}</a></li>
                        </ul>
                    </div>
                    <div class="footer-menu">
                        <h2>{{ __('messages.master.footer.contact_us') }}</h2>
                        <p>Depok Sport Centre<br>Jl. Seturan Kav.4 Depok, Sleman, DIY 55281</p>
                        <p><a class="underline" href="{{ 'https://web.whatsapp.com/'.$main_kontak->phone_num }}" target="_blank"><span class="fa fa-phone &nbsp;"></span> &nbsp; {{ $main_kontak->phone_num }}</a></p>
                        <div class="additional-menu">
                            <h2><a class="underline" href="{{ route('frontend.faq', ['locale' => app()->getLocale()]) }}">FAQ</a></h2>
                            <h2><a class="underline" href="{{ route('frontend.testimoni', ['locale' => app()->getLocale()]) }}">{{ __('messages.master.footer.testimoni') }}</a></h2>
                        </div>
                    </div>
                </div>
            </nav>
        </footer>
        <script>
             AOS.init();
             once:true;
        </script>
    </body>
    
</html>