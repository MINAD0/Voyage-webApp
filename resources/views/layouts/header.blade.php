<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <title>@yield('title')</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="" name="keywords">
            <meta content="" name="description">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- Favicon -->
            <link href="{{Voyager::image(setting('site.logo'))}}" rel="icon">

            <!-- Google Web Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

            <!-- Icon Font Stylesheet -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

            <!-- Libraries Stylesheet -->
            <link href="{{ asset('lib/animate/animate.min.css')}}" rel="stylesheet">
            <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

            <!-- Customized Bootstrap Stylesheet -->
            <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

            <!-- Template Stylesheet -->
            <link href="{{ asset('css/style.css')}}" rel="stylesheet">

            <link href="{{ asset('assets-minia/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />


        </head>

        <body>
            <div class="container-xxl bg-white p-0">
                <!-- Spinner Start -->
                <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <!-- Spinner End -->


                <!-- Navbar Start -->
                <div class="container-fluid nav-bar bg-transparent">
                    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                        <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                            <div class="icon p-2 me-2">
                                <img class="img-fluid" src="{{ Voyager::image(setting('site.logo')) }}" alt="Icon" style="width: 30px; height: 30px;">
                            </div>
                            <h1 class="m-0 text-primary">Travel</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav ms-auto">
                                <a href="/" class="nav-item nav-link active">Accueil</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Voyage</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="/national-voyages" class="dropdown-item">National</a>
                                        <a href="/international-voyages" class="dropdown-item">International</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Hotel</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="/national-hotels" class="dropdown-item">National</a>
                                        <a href="/international-hotels" class="dropdown-item">International</a>
                                    </div>
                                </div>
                                <a href="/contact" class="nav-item nav-link">Contact</a>
                                @guest
                                <a href="/login" class="nav-item nav-link">Connexion <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                @endguest
                            </div>
                            @guest
                            <a href="/register" class="btn btn-primary px-3 d-none d-lg-flex">S'inscrire</a>
                            @endguest
                            @auth
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <li> <button type="submit" class="dropdown-item">Logout</button></li>
                                    </form>
                                </ul>
                            @endauth
                        </div>
                    </nav>
                </div>
                <!-- Navbar End -->

                @yield('header')
