@extends('layouts.main')

@section('title')
TravelAgency - Profile
@endsection



@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Profile</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Bienvenu dans votre espace client</li>
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
    <div class="container-xxl py-5">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="container bg-white d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="row">
                    <!--? Left Bar -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="category-listing mb-50 shadow p-20 mb-2 bg-white rounded">
                            <div class="single-listing">
                                <!-- select-Categories start -->
                                <div class="small-section-tittle2 mb-20 p-4">
                                    <a id="showSidebar" style="font-family: 'Raleway', sans-serif; color:#b4afaf; font-size:16px;"><i class="fa fa-cog" aria-hidden="true"></i> PARAMÉTRAGES</a>
                                </div>
                                <div class="select-Categories pt-20 pb-30" id="sidebar">
                                    <div class="row p-2">
                                        <a class="container" href="">
                                            <i class="fa fa-university" aria-hidden="true"></i>
                                            <span class="sidebarlinks">factures</span>
                                        </a>
                                    </div>
                                    <div class="row p-2">
                                        <a class="container" href="">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <span class="sidebarlinks">Reservations</span>
                                        </a>
                                    </div>
                                    <div class="row p-2">
                                        <a class="container" href="">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                            <span class="sidebarlinks">Favorites</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                        </div>
                    </div>

                    <!-- Profile Info Column -->
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <div class="card border shadow p-5 mb-2 bg-white rounded">
                            <div class="d-flex flex-row justify-content-around">
                                <div class="button-group-area mt-10 d-flex justify-content-center flex-column">
                                    <!-- Avatar Image -->
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset('/storage/'.Auth::user()->avatar) }}" alt="user-avatar" class="d-block rounded-circle mx-auto mb-4 shadow bg-body-tertiary " height="200" width="200" id="uploadedAvatar" />
                                    @else
                                        <p>empty</p>
                                    @endif
                                    <span style="font-size: 16px; text-align: center; font-weight: bold;">{{ucfirst(Auth::user()->name)}}</span>
                                </div>
                                <div class="button-group-area d-flex justify-content-center flex-column">
                                    {{-- change image form --}}
                                    <form action="{{ route('uploadAvatar') }}" enctype="multipart/form-data" method="post" class="mb-4">
                                        @csrf
                                        <input class="form-control mb-2 pb-3 border-0 inputs @error('image') is-invalid @enderror" type="file" name="avatar" id="avatar" accept="image/*">
                                        <button type="submit" class="btn btn-primary border-0 w-100 py-3">Upload Avatar</button>
                                    </form>
                                    {{-- deconnect form --}}
                                    <form action="{{ route('logout')}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary border-0 w-100 py-3">Deconnecter</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Buttons -->
                        </div>
                        <div class="card border p-5 shadow mb-5 bg-white rounded">
                            {{-- form change information --}}
                            <form id="formAccountSettings" method="post" action="{{ route('change_profile') }}">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName" class="form-label">Full Name</label>
                                            <input class="form-control inputs" type="text" id="firstName" name="name" value="{{ Auth::user()->name}}"/>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control inputs" type="text" id="email" name="email" value="{{ Auth::user()->email}}" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="phoneNumber">Telephone</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="phoneNumber" name="phone" class="form-control inputs" value="{{ (Auth::user()->phone) ? Auth::user()->phone : ''}}" placeholder="phone" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control inputs" id="address" name="adresse" value="{{(Auth::user()->adresse) ? Auth::user()->adresse : ''}}" placeholder="adresse" />
                                        </div>
                                    </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary border-0 w-100 py-3">Enregistrer</button>
                                </div>
                            </form>
                            <hr>
                            {{-- form change password --}}
                            <form  method="POST" id="changePasswordForm" action="{{ route('change_password') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">Ancien mot de passe</label>
                                        <input class="form-control inputs" type="password" id="current_password" name="current_password" placeholder="mot de passe" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">Mot de passe</label>
                                        <input class="form-control inputs" type="password" id="new_password" name="password" placeholder="mot de passe" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">Confirmer le mot de passe</label>
                                        <input class="form-control inputs" type="password" id="new_confirmation_password" name="password_confirmation" placeholder="Confirme mot de passe" />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary border-0 w-100 py-3">Change mot de passe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Function to toggle the sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('d-none'); // Toggle the "d-none" class to hide/show the sidebar
        }

        // Add an event listener to the "Paramètres" button, but only on mobile devices
        const toggleSidebarBtn = document.getElementById('showSidebar');
        const isMobileDevice = window.matchMedia('(max-width: 767px)').matches; // Check if the screen width is less than 768px (i.e., mobile)
        if (isMobileDevice) {
            toggleSidebarBtn.addEventListener('click', toggleSidebar);
        } else {
            // If not a mobile device, hide the button
            toggleSidebarBtn.style.display = '';
        }
    </script>
@endsection
