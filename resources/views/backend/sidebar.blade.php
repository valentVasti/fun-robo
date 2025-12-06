<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $activePage }}</title>

    <link href="{{ mix('css/backend/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/5eb756d83d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ mix('js/backend.js') }}"></script>
    <script src="{{ mix('js/datetime.js') }}"></script>
    <script src="{{ mix('js/search.js') }}"></script>
    <script src="{{ mix('js/pagination.js') }}"></script>
    <script src="{{ mix('js/ckeditor.js') }}"></script>
    <script src="{{ mix('js/table.js') }}"></script>
    
</head>

<body>
    <div class="sidebar">
        <img src="{{ asset('images/logo/Logo_5.png') }}">

        <ul>
            <a href="{{ route('dashboard.index') }}">
                <li class="{{ isset($activePage) && $activePage === 'dashboard' ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i>Dashboard</li>
            </a>
            <a href="{{ route('user.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'user' ? 'active' : '' }}"><i class="fa-solid fa-user"></i>User</li>
            </a>

            <a href="{{ route('article.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'article' ? 'active' : '' }}"><i class="fa-regular fa-newspaper"></i>Article</li>
            </a>

            <a href="{{ route('tag.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'tag' ? 'active' : '' }}"><i class="fa-solid fa-tag"></i>Tag</li>
            </a>

            <a href="{{ route('faq.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'faq' ? 'active' : '' }}"><i class="fa-solid fa-circle-question"></i>FAQ</li>
            </a>

            <a href="{{ route('awards.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'awards' ? 'active' : '' }}"><i class="fa-solid fa-award"></i>Awards</li>
            </a>

            <a href="{{ route('testimoni.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'testimoni' ? 'active' : '' }}"><i class="fa-regular fa-comment-dots"></i>Testimoni</li>
            </a>

            <a href="{{ route('branch.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'branch' ? 'active' : '' }}"><i class="fa-solid fa-building"></i>Branch</li>
            </a>

            <a href="{{ route('curriculum.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'curriculum' ? 'active' : '' }}"><i class="fa-solid fa-graduation-cap"></i>Curriculum</li>
            </a>

            <a href="{{ route('about_us.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'about_us' ? 'active' : '' }}"><i class="fa-solid fa-users"></i>About Us</li>
            </a>

            <a href="{{ route('benefit.index', ['data_per_page' => 10]) }}">
                <li class="{{ isset($activePage) && $activePage === 'benefit' ? 'active' : '' }}"><i class="fa-regular fa-thumbs-up"></i>Benefit</li>
            </a>

        </ul>

        <ul class="logout">
            <form method="POST" action="{{ route('logout.auth') }}">
                @csrf
                <button type="submit">
                    <li><i class="fa-solid fa-right-from-bracket"></i>Logout</li>
                </button>
            </form>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>

    @if(request()->query('status'))
    <div id="notify-success" class="hidden" data-status="{{ request()->query('status') }}"></div>
    @endif

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const notifyAlert = document.getElementById('notify-success');

            let status = notifyAlert.dataset.status

            console.log('status', status);

            if (status == "Success") {
                Swal.fire({
                    title: "Success!",
                    text: "Data Saved!",
                    icon: "success"
                });
            }
        });
    </script>
</body>

</html>