<div class="spanner">
    <div class="container spanner1">
        <div class="row">
            <div class="col-xl-8">
                <div id="carouselExampleCrossfade" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators">
                   
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active hvr-trim">
                            <img src="../../public/img/carousels/carousel_1.jpg" class="d-block w-100" alt="Wild Landscape" />
                        </div>
                        <div class="carousel-item hvr-trim">
                            <img src="../../public/img/carousels/carousel_2.jpg" class="d-block w-100" alt="Camera" />
                        </div>
                        <div class="carousel-item hvr-trim">
                            <img src="../../public/img/carousels/carousel_3.jpg" class="d-block w-100" alt="Exotic Fruits" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCrossfade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCrossfade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <script>
                    var carousel = document.getElementById('carouselExampleCrossfade');
                    var interval = 3000;

                    function carouselNext() {
                        var currentSlide = carousel.querySelector('.carousel-item.active');
                        var nextSlide = currentSlide.nextElementSibling || carousel.querySelector('.carousel-item:first-child');

                        currentSlide.classList.remove('active');
                        nextSlide.classList.add('active');
                    }

                    setInterval(carouselNext, interval);
                </script>


            </div>

            <div class="col-xl-4 ">
                <div class="row">
                    <div class="col-xl-12 hvr-shrink">
                        <img src="../../public/img/banner/span1.jpg" alt="" class="img__span hide-tablet hide-mobile ">
                    </div>
                    <div class="col-xl-12 mt-3 hvr-shrink">
                        <img src="../../public/img/banner/span2.jpg" alt="" class="img__span hide-tablet hide-mobile">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end__spanner1 -->
    <div class="container spanner2">
        <div class="row d-flex">
            <div class="col-xl-6 hvr-float-shadow">
                <img src="../../public/img/banner/span3.jpg" alt="" class="hide-tablet hide-mobile">
            </div>
            <div class="col-xl-6 hvr-float-shadow">
                <img src="../../public/img/banner/span4.jpg" alt="" class="hide-tablet hide-mobile">
            </div>
        </div>
    </div>
    <!-- end_spanner2 -->
</div>
<!-- end__spanner -->