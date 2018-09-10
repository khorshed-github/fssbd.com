 <div class="offer-carousel-container">
    <div class="container">
        <div class="row">
            <div class="special-offers">
                <div class="welcome-text-div inner-header-div">
                    <p class="header-one">Special Offers</p>
                    <img src="images/icons/line-small.png" alt="special offers of grand sultan">
                </div>
            </div>
            <div id="offer-carousel" class="facilities-carousel fadeOut owl-carousel owl-theme">
                
                <div class="item">
                    <div class="dot-line-right">
                        <img src="images/offers/spring-offer-2018.jpg" alt="offers grand sultan">
                    </div>
                    <div class="package-text-container offer-text-container">
                        <p class="package-header">Spring Offer</p>
                        <h4 class="offer-date">Valid from 1st February 2018 to 13th April 2018</h4>
                        <p>Starting from BDT 13,200 for 2 persons per night with complimentary breakfast. Enjoy spring in Srimongal - the tea capital of Bangladesh with 45% discount on room rack rate.</p>
                        <a href="spring-offer-2018.html" class="has_transition_400 left">Read More</a>
                    </div>
                </div>

                <div class="item">
                    <div class="dot-line-right">
                        <img src="images/offers/spring-package-2018.jpg" alt="offers grand sultan">
                    </div>
                    <div class="package-text-container offer-text-container">
                        <p class="package-header">Spring Package</p>
                        <h4 class="offer-date">Valid from 1st February 2018 to 13th April 2018</h4>
                        <p>Starting from BDT 14,777 for 2 persons per night with complimentary breakfast, lunch &amp; dinner. Enjoy spring in Srimongal - the tea capital of Bangladesh.</p>
                        <a href="spring-package-2018.html" class="has_transition_400 left">Read More</a>
                    </div>
                </div>

                <div class="item">
                    <div class="dot-line-right">
                        <img src="images/offers/grand-honeymoon-package1.jpg" alt="offers grand sultan">
                    </div>
                    <div class="package-text-container offer-text-container">
                        <p class="package-header">Grand Honeymoon Package</p>
                        <h4 class="offer-date">Valid from 1st January 2018 to 31st March 2018</h4>
                        <p>Enjoy Honeymoon Package starting from BDT 13,333.</p>
                        <a href="grand-honeymoon-package.html" class="has_transition_400 left">Read More</a>
                    </div>
                </div>
            </div><!-- END #services-carousel -->

            <div class="changer-div">
                <div class="customNavigation">
                  <a class="btn offer-prev"></a>
                  <a class="btn offer-next"></a>
                </div>
            </div>

            <!-- Carousel -->
            <script>
            $(document).ready(function() {

              var owl_offer = $("#offer-carousel");
              owl_offer.owlCarousel({
                nav:true,
                items: 2,
                responsive:{
                    0:{
                        items:1
                    },
                    769:{
                        items:2
                    },
                    1000:{
                        items:2
                    }
                },
                dots: false,
                navContainer: '.offer-carousel-container .customNavigation',
                navText: [$('.offer-prev'),$('.offer-next')],
                animateOut: 'fadeOut',
                loop: true,
                autoplay:false,
                margin: 10
              
              });
            });
            </script>
            <!-- End Carousel -->
        </div>
    </div>
</div>                   