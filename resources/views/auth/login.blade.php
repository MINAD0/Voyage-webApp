@extends('layouts.main')

@section('title')
    TravelAgency - Contact
@endsection


@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Connexion</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Connexion</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="{{ Voyager::image(setting('images.carousel2'))}}" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->
@endsection

@section('content')

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Connectez-Vous</h1>
            </div>
                <div class="container bg-white d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4">
                        <div class="container p-5 bg-primary text-white rounded shadow">
                            <form action="{{ route('connect') }}" method="Post">
                            @csrf
                                <div class="col-md-6 mb-4 align-self-start w-100">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                                <div class="col-md-6 mb-4 align-self-start w-100">
                                    <label for="password">Mot de Passe</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="col-md-4 w-100">
                                    <button name="submit" type="submit" class="btn btn-dark border-0 w-100 py-3">Connexion</button>
                                </div>
                                <div class="col-md-4 mt-4 w-100">
                                    <span>Vous n'avez pas encore de compte ?</span>
                                    <a href="/register" class="text-warning text-bold">S'inscrire</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
