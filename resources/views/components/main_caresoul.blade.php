<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active bg-dark" aria-label="Slide 1" aria-current="true"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="bg-dark"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="bg-dark"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active ps-5" >
            <div class="container">
                <div class="carousel-caption text-end " style="top: 100px;">
                    <h1 class="text-dark">World of Music with</h1>
                    <h2 class="text-dark">headphone</h2>
                    <h3 class="text-danger">Offer will end on soon</h3>
                    <p><a class="btn btn-lg @if(isset($ternary_button_color)) {{ $ternary_button_color }} @else btn-primary @endif" href="#">Buy Now</a></p>
                </div>
                <img src="{{ asset('assets/caresoul/caresoul01.jpeg') }}" alt="caresoul">
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="carousel-caption text-end " style="top: 100px;">
                    <h1 class="text-dark">World of Music with</h1>
                    <h2 class="text-dark">headphone</h2>
                    <h3 class="text-danger">Offer will end on soon</h3>
                    <p><a class="btn btn-lg  @if(isset($ternary_button_color)) {{ $ternary_button_color }} @else btn-primary @endif" href="#">Buy Now</a></p>
                </div>
                <img src="{{ asset('assets/caresoul/caresoul02.jpg') }}" alt="caresoul">
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="carousel-caption text-end " style="top: 100px;">
                    <h1 class="text-dark">World of Music with</h1>
                    <h2 class="text-dark">headphone</h2>
                    <h3 class="text-danger">Offer will end on soon</h3>
                    <p><a class="btn btn-lg  @if(isset($ternary_button_color)) {{ $ternary_button_color }} @else btn-primary @endif" href="#">Buy Now</a></p>
                </div>
                <img src="{{ asset('assets/caresoul/caresoul03.jpg') }}" alt="caresoul">
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
