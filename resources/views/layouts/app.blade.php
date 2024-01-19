<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav>
            <div id="hamburger-logo">
                <img src="{{ Vite::asset('public/images/Logo.png') }}" alt="Logo">
                <div class="text-white" id="hamburger">
                    <i id="icon" class="fs-3 fa-solid fa-arrow-left"></i>
                </div>
            </div>

            <div id="nav">
                <ul>
                    <li>
                        <a href="{{ route('admin.projects.index') }}">
                            <h3>Projects</h3>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <h3>Categories</h3>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.technologies.index') }}">
                            <h3>Technologies</h3>
                        </a>
                    </li>
                    {{-- <li><a href="{{ route('admin.technologies.index') }}">Technologies</a></li> --}}
                </ul>
            </div>
            <div id="register-login">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <div id="main-aside" class="d-flex">
            <aside id="aside"></aside>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        const aside = document.getElementById("aside");
        const hamburger = document.getElementById("hamburger");
        const icon = document.getElementById("icon");
        const main = document.querySelector("main");
        let flag = false;
        hamburger.addEventListener("click", (event) => {
            flag = !flag;
            if (flag) {
                aside.style.width = "0%";
                main.style.width = "100%";
                setTimeout(() => {
                    icon.classList.remove('fa-arrow-left')
                    icon.classList.add('fa-arrow-right')
                }, 200);
            } else {
                aside.style.width = "12%";
                setTimeout(() => {
                    icon.classList.remove('fa-arrow-right')
                    icon.classList.add('fa-arrow-left')
                    main.style.width = "88%";
                }, 200);
            }
        });
    </script>
</body>

</html>
