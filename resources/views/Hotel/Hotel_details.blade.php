@extends('layouts.main')

@section('title')
    TravelAgency - International Voyages
@endsection

@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Voyage Details</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Detail</li>
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
    <!-- Voyages Result Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 gap-2">
                <div class="col-xl-8 col-lg-8 col-md-12 shadow-sm p-4 rounded-2 border d-flex flex-column wow fadeInUp"  data-wow-delay="0.1s">
                        <h2>{{$voyages->nom_voyage}}</h2>
                        <div class="d-flex gap-1 p-2">
                            <a href=""><i class="fa fa-handshake" aria-hidden="true"></i> Travel</a>
                            <a href=""><i class="fa fa-map-pin ms-2" aria-hidden="true"></i> {{$voyages->Arrive}}</a>
                        </div>
                        <!-- Carousel wrapper -->
                        <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                            <!-- Indicators -->

                            <!-- Inner -->
                            <div class="carousel-inner">
                            <!-- Single item -->
                            <div class="carousel-item active">
                                <img src="{{ asset('/storage/'.$voyages->image1)}}" class="d-block w-100" alt="Sunset Over the City"/>
                            </div>
                            <!-- Single item -->
                            <div class="carousel-item">
                                @if ($voyages->image2)
                                    <img src="{{ asset('/storage/'.$voyages->image2)}}" class="d-block w-100" alt="Cliff Above a Stormy Sea"/>
                                @else
                                <img src="{{ asset('/storage/'.$voyages->image1)}}" class="d-block w-100" alt="Cliff Above a Stormy Sea"/>
                                @endif
                            </div>
                            </div>
                            <!-- Inner -->
                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Carousel wrapper -->
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 shadow-sm p-4 rounded-2 border d-flex flex-column wow fadeInUp" style="width: 420px" data-wow-delay="0.1s">
                    <h2 class="text-center">Packs à la carte</h2>
                    <div class="icon p-4 mt-2 me-2">
                        <img class="img-fluid" src="{{ Voyager::image(setting('site.logo')) }}" alt="Icon" style="width: 50px; height: 50px;">
                    </div>
                    <h4 class="text-primary text-center py-2">Travel</h4>
                    <a class="d-block text-center h5 mb-2" href="">{{ $voyages->nom_voyage}}</a>
                    <hr>
                    <div class="col-12 py-2 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary px-5" href="">Contact</a>
                    </div>
                    <div class="info py-2">
                        <h6 class="text-muted py-1">Contact Info </h6>
                        <div class="icons ms-3">
                            <h6><span class="font-weight-semibold"><i class="fa fa-map mr-3 mb-2 py-2   " style="color: #00B98E"></i></span>
                                <a href="#" class="text-body"> 30 Rue abdel moumen, Casablanca</a>
                            </h6>
                            <h6><span class="font-weight-semibold"><i class="fa fa-envelope mr-3 mb-2 py-2" style="color: #00B98E"></i></span>
                                <a href="#" class="text-body"> contact@email.ma</a>
                            </h6>
                            <h6><span class="font-weight-semibold"><i class="fa fa-phone mr-3 mb-2 py-2" style="color: #00B98E"></i></span> +212 0555 555 555</h6>
                            <h6><span class="font-weight-semibold"><i class="fa fa-link mr-3 py-2 " style="color: #00B98E"></i></span>
                                <a href="#" target="_blank" class="text-secondary"> https://travel.ma/</a>
                            </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 py-2 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary px-5" style="width: 100%" href="">Réserve</a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12 shadow-sm p-4 rounded-2 border d-flex flex-column wow fadeInUp"  data-wow-delay="0.1s">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Programme
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="text-muted">
                                            <strong class="text-dark">This is the first item's accordion body.</strong> {{$voyages->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Date Disponible
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="text-muted">
                                            <strong class="text-dark">Date Debut:
                                                Date Fin :
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end accordion -->
                    </div>
                    <div class="footer">
                        <div class="col-12 py-2 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary px-5" href=""> <i class="fa fa-print" aria-hidden="true"></i> Print</a>
                            <a class="btn btn-primary px-5" href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a class="btn btn-primary px-5" href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-8" style="width: 420px">
                    <div class="row border p-2 rounded-2 py-2">
                        <h2 class="text-center">Besoin d'aide pour des détails?</h2>
                        <div class="bg-primary py-2 rounded text-center">
                            <a href="tel:0555 555 555" class="text-white">
                                <i class="fa fa-phone rounded-circle bg-muted py-2 me-2" style="color: #eef7f5"></i> +212 0555 555 555
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row border p-4 rounded-2 py-2">
                        <h3 class="text-center">Table de Réservation</h3>
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Depart</th>
                                <th>Arrive</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($dateDisponibilities as $item)

                                @endforeach
                            <tr>
                                <td> <strong>Depart:</strong>  {{$item->date_debut}} <strong>Arrive :</strong> {{$item->date_fin}}</td>
                                <td>{{$voyages->Depart}}</td>
                                <td>{{$voyages->Arrive}}</td>
                                <td>{{$voyages->prix}} par personne</td>
                                <td>2011/07/25</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Voyages End -->

@endsection

