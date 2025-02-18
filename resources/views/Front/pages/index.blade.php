@extends('Front.Layouts.layout')

@section('title', 'IoGlobe')

@section('content')

    <div class="container-fluid" id="home">
        {{-- <img alt="Fire alarm system on a wall" class="background-image" src="https://placehold.co/1200x400" /> --}}
        
        <img src="{{ asset('front/images/banner_image_background.png') }}" alt="banner image" style="" class="bannerimage">
        {{-- <img src="{{ asset('front/images/banner.png') }}" alt="banner image" style="" class="bannerimage"> --}}
        <div class="overlay">
            <div class="content">
                <h1 style="font-size: 42px; color:white;">Protect Your Home &amp; Business with <br>Our Fire Alarm Systems</h1>
                <strong><p style="color:white;">Safety | Reliability | Cutting-Edge Technology</p></strong>
                <a class="button" href="#contact">Get a Free Quote</a>
            </div>
        </div>

        
    </div>


    <div class="container-fluid about-section" id="about">
        <div class="row">
            <div class="col-md-6 about-content">
                <h2> More About Us</h2>
                <p> Over the years, we’ve learned that great service begins and ends with experienced<br> and friendly professionals, which explains our rigorous hiring process. We believe <br> that our team is the best in the business, and have complete and total confidence in <br>every person providing our services.
                    IoGlobe  finishes each project on schedule and with the highest <br> level of quality. With a focus on personalized service, competitive rates and customer satisfaction, we’re<br> always striving to meet and exceed expectations.</p>
            </div>

            <div class="col-md-6 about-image">
                <img src="{{ asset('front/images/aboutus_fire_image.png') }}"  alt="FireAlarm Logo" style="margin-right: 10px;width:650px;">
            </div>
        </div>
    </div>
     

    <div class="container text-center my-5" id="features">
        <h3 style="color:black;">Features of our Fire Alarm Systems</h3>
        <div class="row mt-4">
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <i class="fas fa-bell feature-icon"></i>
                    <div class="feature-text1">Early Detection</div>
                    <div class="feature-text">Detects Fire at the earliest stage to ensure Maximum Safety</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <i class="fas fa-wifi feature-icon"></i>
                    <div class="feature-text1">Wireless Connectivity</div>
                    <div class="feature-text">Seamless Integration with your home or business network.</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <i class="fas fa-mobile-alt feature-icon"></i>
                    <div class="feature-text1">Mobile App Alerts</div>
                    <div class="feature-text">Receive instant alerts on your smartphone.</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <i class="fas fa-battery-full feature-icon"></i>
                    <div class="feature-text1">Battery Backup</div>
                    <div class="feature-text">Ensures continuous operation even during power outages.</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <i class="fas fa-shield-alt feature-icon"></i>
           
                    <div class="feature-text1">24/7 Monitoring</div>
                    <div class="feature-text">Round-the-clock monitoring for your peace of mind.</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <i class="fas fa-tools feature-icon"></i>
                    <div class="feature-text1">Easy Installation</strong></div>
                    <div class="feature-text">Quick and hassle-free installation process.</div>
                </div>
            </div>
        </div>
    </div>


     {{-- Service section --}}
    <div class="container text-center py-5" id="services">
        <h2 class="mb-5" style="color:black;">Our Services</h2>
        <div class="row">
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="service-item">
                    <i class="fas fa-wrench service-icon"></i>
                    <div class="service-title">Installation</div>
                    <div class="service-description">Professional installation services for both residential and commercial properties.</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="service-item">
                    <i class="fas fa-cogs service-icon"></i>
                    <div class="service-title">Maintenance</div>
                    <div class="service-description">Regular maintenance to ensure your fire alarm system is always into condition.</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="service-item">
                    <i class="fas fa-headset service-icon"></i>
                    <div class="service-title">24/7 Monitoring</div>
                    <div class="service-description">Continuous monitoring to provide immediate response in case of emergencies.</div>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Product Highlights --}}
    <div class="hero-section">
        <img src="{{ asset('front/images/Product_highlights.png') }}" alt="Product_highlights" class="Producthighlights">
        <div class="hero-text">
            <h2><strong>Product Highlights</strong> </h2>
            <p style="color: white;">The newest technology is used in the design of our contemporary fire alarm systems to provide optimal safety and usability. Our systems <br> offer dependable security for your house or place of business with features including early detection, wireless connectivity, mobile app <br> notifications, and battery backup.</p>
        </div>
    </div><br>
   {{-- End --}}
 
   {{-- Testimonial --}}
    {{-- <div class="container-fluid testimonial-container" id="testimonials">
         <div class="testimonial-title">Testimonials</div>
            <div class="testimonial-content">
                <img src="{{ asset('front/images/Product_highlights.png') }}" alt="Profile picture of Pankaj Pal" class="testimonial-image"><br><br>
                <div class="testimonial-name">Pankaj Pal</div><br>
                <div class="testimonial-text">“The installation was quick and professional. I feel much safer knowing my home<br> is protected 24/7.”</div>
            </div>

            <div class="testimonial-content">
                <img src="{{ asset('front/images/Product_highlights.png') }}" alt="Profile picture of Pankaj Pal" class="testimonial-image"><br><br>
                <div class="testimonial-name">Ashu</div><br>
                <div class="testimonial-text">“The installation was quick and professional. I feel much safer knowing my home<br> is protected 24/7.”</div>
            </div>

            <div class="testimonial-nav"> 
                <button>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button>
                    <i class="fas fa-chevron-right"></i>
                </button>
           </div>
    </div><br> --}}

    <div class="container-fluid testimonial-container" id="testimonials">
        <div class="testimonial-title">Testimonials</div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide testimonial-content">
                    <img src="{{ asset('front/images/Product_highlights.png') }}" alt="Profile picture of Pankaj Pal" class="testimonial-image">
                    <div class="testimonial-name">Pankaj Pal</div>
                    <div class="testimonial-text">“The installation was quick and professional. I feel much safer knowing my home is protected 24/7.”</div>
                </div>
                <div class="swiper-slide testimonial-content">
                    <img src="{{ asset('front/images/Product_highlights.png') }}" alt="Profile picture of Ashu" class="testimonial-image">
                    <div class="testimonial-name">John</div>
                    <div class="testimonial-text">“The installation was quick and professional. I feel much safer knowing my home is protected 24/7.”</div>
                </div>
            </div>
            <!-- Navigation buttons -->
            <div class="swiper-button-prev d-none"></div>
            <div class="swiper-button-next d-none"></div>
        </div>
    </div>
    

   {{-- End --}}

   {{-- Product Your Property --}}
   <div class="container-fluid product">
         <h1>Ready to Product Your Property?</h1><br>
         <h3>Schedule a free fire alarm consultation or request a safety audit today!</h3>
         <br>
        <button type="button" class="btn btn-danger">Contact Us </button>
    </div><br>
   {{-- Endd --}}

   {{-- Contact us --}}
   <div class="contact-container" id="contact">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p><strong>Phone:</strong> +91-9324336434</p>
            <p><strong>Email:</strong> kess.customercare@gmail.com</p>
            <p><strong>Location:</strong> 578, bhoir nivas ,jihu village,sector 11,vashi,navi mmbai, 400703.  </p>
            <p><strong>Business Hours:</strong> Mon-Fri 9am-5pm</p>
        </div>

    <div class="contact-form">
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="mobile" placeholder="Mobile" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <textarea name="message" rows="4" placeholder="Message" required></textarea>
            {{-- <button type="submit">Submit</button> --}}
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>
  {{-- End --}}
  

   {{-- <script>
    $(document).ready(function(){
        // Smooth scrolling for internal links except for the Home link
        $('a[href^="#"]').not('a[href="#home"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 800);
            }
         });

       $(window).on('scroll', function() {
       var scrollPosition = $(window).scrollTop();
       $('.navbar-nav a').css('color', ''); // Reset the color for all links
       $('.navbar-nav a[href^="#"]').each(function() {
           var currentLink = $(this);
           var refElement = $(currentLink.attr("href"));
           if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
               currentLink.css('color', 'red'); // Set inline color to red for the active link
           }
       });
   });


        // Highlight "Home" link when at the top of the page
        $(window).on('load', function() {
            var scrollPosition = $(window).scrollTop();
            if (scrollPosition === 0) {
                $('.navbar-nav a[href="#home"]').addClass("active");
            }
        });
    });

</script> --}}
    


<script>
    $(document).ready(function () {
        // Smooth scrolling for internal links
        $('a[href^="#"]').on('click', function (event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 70 // Adjust for fixed navbar height
                }, 800);

                // Close the navbar in mobile view
                if ($('.navbar-toggler').is(':visible')) {
                    $('.navbar-collapse').collapse('hide');
                }
            }
        });

        // Highlight the active link on scroll
        $(window).on('scroll', function () {
            var scrollPosition = $(window).scrollTop();
            $('.navbar-nav a').removeClass('active'); // Remove active class from all links
            $('.navbar-nav a[href^="#"]').each(function () {
                var currentLink = $(this);
                var refElement = $(currentLink.attr("href"));
                if (refElement.length && refElement.offset().top - 80 <= scrollPosition && refElement.offset().top + refElement.height() > scrollPosition) {
                    currentLink.addClass('active'); // Add active class to the current link
                }
            });
        });

        // Highlight "Home" link when at the top of the page
        $(window).on('load', function () {
            var scrollPosition = $(window).scrollTop();
            if (scrollPosition === 0) {
                $('.navbar-nav a[href="#home"]').addClass("active");
            }
        });
    });
</script>

<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 1,
        spaceBetween: 10,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });
</script>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Contact form submitted successfully',
            text: "Thank you! We'll get back to you soon.",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif
@endsection