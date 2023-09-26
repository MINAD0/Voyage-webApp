(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.nav-bar').addClass('sticky-top');
        } else {
            $('.nav-bar').removeClass('sticky-top');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });

})(jQuery);

$(function() {

    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

});


document.addEventListener('DOMContentLoaded', function () {
    const voyageForm = document.getElementById('VoyageForm');
    const hotelForm = document.getElementById('HotelForm');
    const voyageRadio = document.getElementById('flexRadioDefault2');
    const hotelRadio = document.getElementById('flexRadioDefault1');

    function toggleForm() {
        if (voyageRadio.checked) {
            voyageForm.classList.remove('d-none');
            voyageRadio.style.backgroundColor = '#ffc107';
            hotelRadio.style.backgroundColor = '#fff';
            hotelForm.classList.add('d-none');
        } else if (hotelRadio.checked) {
            hotelForm.classList.remove('d-none');
            hotelRadio.style.backgroundColor = '#ffc107';
            voyageRadio.style.backgroundColor = '#fff';
            voyageForm.classList.add('d-none');
        }
    }

    voyageRadio.addEventListener('click', toggleForm);
    hotelRadio.addEventListener('click', toggleForm);

    // Initially show the Voyage form
    toggleForm();
});

//filter search range input price

var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value; // Display the default slider value

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            output.innerHTML = this.value;
        }


