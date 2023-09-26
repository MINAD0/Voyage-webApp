@extends('layouts.main')

@section('title')
    TravelAgency - Home
@endsection

@section('header')
    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">TROUVEZ UN<span class="text-primary"> VOYAGE PARFAIT </span> POUR VOUS ET VOTRE FAMILLE</h1>
                <p class="animated fadeIn mb-4 pb-2">{{ setting('site.description') }} .</p>
                <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Get Started</a>
            </div>
            <div class="col-md-6 animated fadeIn">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{Voyager::image(setting('images.carousel'))}}" alt="">
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{Voyager::image(setting('images.carousel2'))}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
@endsection


@section('content')
    @include('content.search')

    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Property Types</h1>
                <p>Planifiez votre voyage avec le meilleur conseiller Touristique</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <img class="img-fluid" src="{{Voyager::image(setting('icons.plane'))}}" alt="Icon">
                            </div>
                            <h6>Apartment</h6>
                            <span>123 </span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <img class="img-fluid" src="{{Voyager::image(setting('icons.map'))}}" alt="Icon">
                            </div>
                            <h6>Office</h6>
                            <span>123 </span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <img class="img-fluid" src="{{Voyager::image(setting('icons.hotel'))}}" alt="Icon">
                            </div>
                            <h6>Hotel</h6>
                            <span>123 </span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <img class="img-fluid" src="{{Voyager::image(setting('icons.placeholder'))}}" alt="Icon">
                            </div>
                            <h6>Destination</h6>
                            <span>123</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="{{Voyager::image(setting('images.about'))}}">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Voyage List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                <h1 class="mb-3">Nos Bons Plans</h1>
                <p>Votre Voyages Notre Passion !</p>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @foreach ($voyages as $voyage)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="{{ asset('/storage/'.$voyage->image1)}}" style="width: 100%; height: 100%; object-fit: cover;" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $voyage->prix}} DH</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Depart {{ $voyage->Depart}}</div>
                                    </div>
                                    <div class="p-4 pb-0 card-contente">
                                        <h5 class="text-primary mb-3">{{ $voyage->pay->nom_pays}}</h5>
                                        <a class="d-block h5 mb-2" href="">{{ $voyage->Arrive}}</a>
                                        <?php
                                        // Split description
                                        $words = explode(' ', $voyage->description);
                                        // 50 mots
                                        $limitedWords = array_slice($words, 0, 20);

                                        $limitedDescription = implode(' ', $limitedWords);
                                        ?>
                                        <p>{{ $limitedDescription }}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-sun text-primary" aria-hidden="true"></i> {{ $voyage->jour}} J</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-moon text-primary" aria-hidden="true"></i> {{ $voyage->nuit}} N</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Voyage List End -->


    <!-- Call to Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded w-100" src="{{Voyager::image(setting('images.getinTouch'))}}" alt="">
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h1 class="mb-3">Contact With Our Certified Agent</h1>
                                <p>Eirmod sed ipsum dolor sit rebum magna erat. Tempor lorem kasd vero ipsum sit sit diam justo sed vero dolor duo.</p>
                            </div>
                            <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                            <a href="/contact" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->



    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Nos clients disent!</h1>
                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Client Name</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Client Name</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Client Name</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection




@section('scripts')
    {{-- <script>
        const wrapper = document.querySelector(".wrapper"),
        selectBtn = wrapper.querySelector(".select-btn"),
        searchInp = wrapper.querySelector("input"),
        options = wrapper.querySelector(".options");


        let countries = @json($countries);


        function addCountry(selectedCountry) {
            options.innerHTML = "";
            Object.entries(countries).forEach(([id, destination]) => {
                let isSelected = destination == selectedCountry ? "selected" : "";
                let li = `<li onclick="updateName(this)" name="destination" value="${id}" class="${isSelected}">${destination}</li>`;
                options.insertAdjacentHTML("beforeend", li);
            });
        }
        addCountry();


        function updateName(selectedLi) {
            searchInp.value = "";
            addCountry(selectedLi.innerText);
            wrapper.classList.remove("active");
            selectBtn.firstElementChild.innerText = selectedLi.innerText;
        }

        searchInp.addEventListener("keyup", () => {
            let arr = [];
            let searchWord = searchInp.value.toLowerCase();
            arr = countries.filter(data => {
                return data.toLowerCase().startsWith(searchWord);
            }).map(data => {
                let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
                return `<li onclick="updateName(this)" name="destination" value="${id}" class="${isSelected}">${data}</li>`;
            }).join("");
            options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Country not found</p>`;
        });

        selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));
    </script> --}}
    <script src="asset{{('js/choices.min.js')}}"></script>
@endsection
