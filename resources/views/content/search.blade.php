<!-- Search Start -->
<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <div class="row g-2 justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="form-check">
                    <i class="fa fa-plane text-white" aria-hidden="true"></i>
                    <input class="form-check-input  border-0" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label text-white" for="flexRadioDefault2">
                        Voyage
                    </label>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="form-check">
                    <i class="fa fa-bed text-white" aria-hidden="true" ></i>
                    <input class="form-check-input border-0" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label text-white" for="flexRadioDefault1">
                        Hotel
                    </label>
                </div>
            </div>
        </div>
        <form action="{{route('searchVoyage')}}" method="post" id="VoyageForm">
            @csrf
            <div class="row g-2 justify-content-center">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select class="form-control form-select py-3" data-trigger name="depart"
                                id="choices-single-default"
                                placeholder="Rechercher ici">
                                <option value="">Depart <i class="fas fa-ad"></i></option>
                                @foreach ($voyages->unique('Depart') as $voyage)
                                    <option value="{{$voyage->Depart}}">{{$voyage->Depart}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control form-select p-4" data-trigger name="arrive"
                            id="choices-single-default"
                            placeholder="Rechercher ici">
                            <option value="">Arrive</option>
                            @foreach ($voyages->unique('Arrive') as $voyage)
                                <option value="{{$voyage->Arrive}}">{{$voyage->Arrive}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="datefilter" class="form-control border-0 py-3" placeholder="Search date" required >
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="adult" class="form-control border-0 py-3" placeholder="Nombre Personne" max="20" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="enfant" class="form-control border-0 py-3" placeholder="Nombre Enfant (0)" max="20" min="0">
                        </div>
                        <div class="col-md-4">
                            <button name="submit" type="submit" class="btn btn-dark border-0 w-100 py-3">Rechercher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{route('searchHotel')}}" method="post" id="HotelForm" class="d-none">
            @csrf
            <div class="row g-2 justify-content-center">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select class="form-control form-select py-3" data-trigger name="ville"
                                id="choices-single-default"
                                placeholder="Rechercher ici">
                                <option value=""> Destination <i class="fas fa-ad"></i></option>
                                @foreach ($hotels->unique('ville_id') as $hotel)
                                    <option value="{{$hotel->id}}">{{$hotel->ville->nom_ville}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="datefilter" class="form-control border-0 py-3" placeholder="Search date" required >
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="adult" class="form-control border-0 py-3" placeholder="Nombre Personne" max="20" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="enfant" class="form-control border-0 py-3" placeholder="Nombre Enfant (0)" max="20" min="0">
                        </div>
                        <div class="col-md-4">
                            <button name="submit" type="submit" class="btn btn-dark border-0 w-100 py-3">Rechercher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Search End -->



