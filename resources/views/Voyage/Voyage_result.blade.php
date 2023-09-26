@extends('layouts.main')

@section('title')
    TravelAgency - Voyages Disponible
@endsection

@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Recherche Resultats</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Voyages Dispo</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="img/header.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->
@endsection

@section('content')
    @include('content.search')
    <!-- Voyages Result Start -->
    <div class="container-xxl py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Voyage à disposition</h1>
        </div>
            <div class="container g-2">
                <div class="row g-4">
                    <div class="col-xl-4 col-lg-4 col-md-6 shadow p-3 rounded-2 border d-flex flex-column wow fadeInUp" style="width: fit-content;" data-wow-delay="0.1s">
                        <form action="{{route('VoyageFilter')}}" method="Post" id="advancedFilterForm">
                        @csrf
                            <div class="row">
                                            <div class="col-12 text-center">
                                                <h3>Advanced Filter</h3>
                                            </div>
                            </div>
                            <div class="col-md-6 mb-2 align-self-start w-100">
                                <label for="ville">Filter by</label>
                                <select class="form-control bg-white form-select py-3 ml-3" id="type" name="type"
                                placeholder="Rechercher ici">
                                    <option value="">Type<i class="fas fa-ad"></i></option>
                                    <option value="0">National</option>
                                    <option value="1">International</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2 align-self-start w-100">
                                <label for="ville">Ville Depart</label>
                                <select class="form-control form-select py-3 wd-200" id="villeDepart" data-trigger name="villeDepart"
                                id="choices-single-default"
                                placeholder="Rechercher ici">
                                    <option value=""> Destination <i class="fas fa-ad"></i></option>
                                    @foreach ($voyages->unique('Depart') as $voyage)
                                            <option value="{{$voyage->Depart}}">{{$voyage->Depart}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2 align-self-start w-100">
                                <label for="ville">Ville Arrive</label>
                                <select class="form-control form-select py-3 wd-200" id="villeArrive" data-trigger name="villeArrive"
                                    id="choices-single-default"
                                    placeholder="Rechercher ici">
                                    <option value=""> Destination <i class="fas fa-ad"></i></option>
                                    @foreach ($voyages->unique('Arrive') as $voyage)
                                        <option value="{{$voyage->Arrive}}">{{$voyage->Arrive}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ms-1">
                                <h4>Prix</h4>
                            </div>
                            <div class="col-md-4 mb-2 ms-2 w-100">
                                <label for="prix1">500 DH - 5000 DH</label>
                                <input type="range" name="range" min="500" max="5000" value="50" step="100" class="form-control-range range-slider w-100" id="myRange">
                                <span id="demo">0</span>
                            </div>
                            <div class="col-md-4 w-100">
                                <button name="submit" type="submit" class="btn btn-dark border-0 w-100 py-3">Filltrer</button>
                            </div>
                        </form>
                    </div>
                    @if ($voyagesresults->isEmpty())
                        <div class="col-12 text-center mt-4">
                            <p>No voyages found for the selected criteria.</p>
                        </div>
                    @else
                    <div class="container g-2 shadow-none d-flex mt-4" style="width: 70%"  id="voyageListContainer">
                        @foreach ($voyagesresults as $voyage)
                            <div class="col-xl-4 col-lg-4 col-md-6 ms-2 rounded-2 d-flex flex-column wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="{{ asset('/storage/'.$voyage->image1)}}" style="width: 100%; height: 100%; object-fit: cover;" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $voyage->prix}} DH</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Depart {{ $voyage->Depart}}</div>
                                    </div>
                                    <div class="p-4 pb-0 contente">
                                        <h5 class="text-primary mb-3">{{ $voyage->pay->nom_pays}}</h5>
                                        <a class="d-block h5 mb-2" href="">{{ $voyage->Arrive}}</a>
                                        <?php
                                        // Split description
                                        $words = explode(' ', $voyage->description);
                                        // 50 mots
                                        $limitedWords = array_slice($words, 10, 20);

                                        $limitedDescription = implode(' ', $limitedWords);
                                        ?>
                                        <p>{!! $limitedDescription !!}</p>
                                        <a href="{{route('VoyageDetail', $voyage->id)}}">More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="d-flex border-top mt-2">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-sun text-primary" aria-hidden="true"></i> {{ $voyage->jour}} J</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-moon text-primary" aria-hidden="true"></i> {{ $voyage->nuit}} N</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Voyages End -->

@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        $('#advancedFilterForm').submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            // alert(formData);

            $.ajax({
                url: "{{ route('VoyageFilter') }}",
                method: 'POST',
                data: formData,
                success: function (data) {
                    // console.log(data);
                    $('#voyageListContainer').empty();
                    $('#voyageListContainer').html($(data).find('#voyageListContainer').html());
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("Error fetching data." + error + status);
                }
            });
            return false;
        });
    });
</script>
@endsection
