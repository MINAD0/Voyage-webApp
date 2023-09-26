@extends('layouts.main')

@section('title')
    TravelAgency - Reservation
@endsection

@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Réservation</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Paiment</li>
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
    <!-- Voyages Result Start -->
    <div class="container-xxl py-5 d-flex">
        <div class="col-xl-12 col-lg-12 col-md-12 p-4  gap-2  d-flex flex-column wow fadeInUp"  data-wow-delay="0.1s">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Renseignements personnels</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="utmsource" id="utmsource" value="">
                    <div class="">
                        <div class="col-sm-12 col-md-12 my-2">
                            <div class="form-group">
                                <label class="form-label border-bottom-0">NOM COMPLETE</label>
                                <input type="text" value="" name="name" required="" class="form-control " placeholder="Nom complete">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 my-2">
                            <div class="form-group">
                                <label class="form-label">EMAIL</label>
                                <input id="email" type="email" class="form-control " name="email" value="" required="" autocomplete="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 my-2">
                            <div class="form-group">
                                <label class="form-label">TELEPHONE</label>
                                <input id="phone" type="text" class="form-control " name="phone" value="" required="" autocomplete="email" placeholder="TELEPHONE">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 my-2">
                            <div class="form-group">
                                <label class="form-label">ADRESSE</label>
                                <input id="adresse" type="text" class="form-control " name="adresse" value="" required="" autocomplete="email" placeholder="ADRESSE">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tarif</h3>
                </div>
                <div class="card-body">
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
                            <tr>
                                <td> <strong>Depart:</strong>   <strong>Arrive :</strong> </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Disponibilités</h3>
                </div>
                <div class="card-body">
                    <h5>NOMBRE DE CHAMBRE :</h5>
                    <div class="col-md-4 mb-2">
                        <select class="form-control form-select py-3" data-trigger name="ville"
                            id="choices-single-default"
                            placeholder="Rechercher ici">
                            <option value=""> Destination <i class="fas fa-ad"></i></option>
                            @foreach ($hotels->unique('ville_id') as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->ville->nom_ville}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class=" text-center ">ADULTE(S)</th>
                                    <th class=" text-center">1ER ENFANT (3-12ANS) </th>
                                    <th class=" text-center">2ÈME ENFANT</th>
                                    <th class=" text-center">BÉBÉ (-3ANS)</th>
                                    <th class=" text-center">VUE</th>


                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </table>
                        <table id="pb-table" class="" style="width:100%;height: 43px;">

                            <tbody>
                                <tr style="background: #00B98E" class="text-white">
                                    <td class="fs-16 font-weight-semibold text-center ">MONTANT TOTAL À PAYER</td>
                                    <td class="fs-16 font-weight-semibold text-center"><label id="totale" for="">75400</label> /DH</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="float-right d-flex justify-content-end mt-2">
                <a href="" class="btn btn-primary ">Réserver</a>
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
