@extends('layouts.main')

@section('title')
    TravelAgency - International Voyages
@endsection

@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">International Voyages</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">International Voyages</li>
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
    @include('content.search')
    <!-- National Hotels List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Voyages Disponible</h1>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @if ($voyages->isEmpty())
                            <div class="col-lg-12 text-center">
                                <h1 class="text-primary">No voyages available</h1>
                            </div>
                        @else
                            @foreach ($voyages as $voyage)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="{{ asset('/storage/'.$voyage->image1)}}" style="width: 100%; height: 100%; object-fit: cover;" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $voyage->prix}} DH</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Depart {{ $voyage->Depart}}</div>
                                    </div>
                                    <div class="p-4 pb-0 contente">
                                        <h5 class="text-primary mb-3">{{ $voyage->pay->nom_pays}}</h5>
                                        <a class="d-block h5 mb-2" href="">{{ $voyage->nom_voyage}}</a>
                                        <?php
                                        // Split description
                                        $words = explode(' ', $voyage->description);
                                        // 50 mots
                                        $limitedWords = array_slice($words, 10, 20);

                                        $limitedDescription = implode(' ', $limitedWords);
                                        ?>
                                        <p>{!! $limitedDescription !!}</p>
                                        <form action="{{route('VoyageDetail', $voyage->id)}}" method="GET">
                                            <input type="hidden" name="voyageId" value="{{$voyage->id}}">
                                            <button type="submit" class="btn btn-primary" style="margin-right: 0">More <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                        </form>
                                        {{-- <a href="{{route('VoyageDetail', $voyage->id)}}">More <i class="fa fa-arrow-right" aria-hidden="true"></i></a> --}}
                                    </div>
                                    <div class="d-flex border-top mt-2">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-sun text-primary" aria-hidden="true"></i> {{ $voyage->jour}} J</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-moon text-primary" aria-hidden="true"></i> {{ $voyage->nuit}} N</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- List End -->

@endsection
