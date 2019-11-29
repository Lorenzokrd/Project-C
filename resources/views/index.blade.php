@include('include.navbar')

<?php function Makestars($rating){
    for($x=0; $x<5; $x++){
        if($rating >= 1 ){
            echo "<i class='fas fa-star'></i>";
            $rating--;
        }
        elseif($rating > 0 && $rating < 1){
            echo "<i class='fas fa-star-half-alt'></i>";
            $rating--;
        }
        else {
            echo "<i class='far fa-star'></i>";
        }
    }
} ?>

<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{URL('/images/pizza.png')}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{URL('/images/sushi.png')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{URL('/images/steak.png')}}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container restaurant-grid" style="padding-bottom:100px">
    <div class="row">
        <div class="col-lg-2">
            <p style="font-weight:700">Categorieën</p>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cat1">
                <label class="custom-control-label" for="cat1">Alcohol</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cat2">
                <label class="custom-control-label" for="cat2">Amerikaans</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cat3">
                <label class="custom-control-label" for="cat3">Arabisch</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cat4">
                <label class="custom-control-label" for="cat4">Aziatisch</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cat5">
                <label class="custom-control-label" for="cat5">BBQ</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cat6">
                <label class="custom-control-label" for="cat6">Bowls</label>
            </div>
            <br><br>
            <p style="font-weight:700">Dieet</p>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet1">
                <label class="custom-control-label" for="diet1">Vegetarisch</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet2">
                <label class="custom-control-label" for="diet2">Vegan</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet3">
                <label class="custom-control-label" for="diet3">Organisch</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet4">
                <label class="custom-control-label" for="diet4">Gluten vrij</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet5">
                <label class="custom-control-label" for="diet5">Halal</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet6">
                <label class="custom-control-label" for="diet6">Lactose vrij</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="diet7">
                <label class="custom-control-label" for="diet7">Zonder koriander</label>
            </div>
            <br><br>
            <p style="font-weight:700">Min. Bestelbedrag</p>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="price1">
                <label class="custom-control-label" for="price1">Vanaf €5,00</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="price2">
                <label class="custom-control-label" for="price2">Vanaf €10,00</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="price3">
                <label class="custom-control-label" for="price3">Vanaf €15,00</label>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="row">
                <div class="filters-top">
                    <div class="filter-btn dropdown float-right">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Prijs
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/1/1">Hoog - laag</a>
                        <a class="dropdown-item" href="/2/2">Laag - hoog</a>
                      </div>
                    </div>
                    <div class="filter-btn dropdown float-right">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                          Soorteer op
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Favoriet</a>
                          <a class="dropdown-item" href="#">Rating</a>
                          <a class="dropdown-item" href="#">Bezorgtijd</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($restaurants as $restaurant)
                @if($restaurant->approved == 1)
            <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/{{$restaurant->name}}';">
                    <div class="restaurant-card" style="background-image:url({{ asset('storage/'.str_replace('public/', '', $restaurant->image)) }});">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> {{$restaurant->name}}</p>
                        </div>
                        <div class="status restaurant-status-recommended">
                            <p>Aanbevolen voor jou</p>
                        </div>
                        
                        <div class="restaurant-info">
                            <div class="restaurant-score"><?php Makestars($restaurant->rating) ?></div>
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. {{ $restaurant->min_order_price}}</p>
                        <p class="time"><i class="far fa-clock"></i> 30 min</p>
                            <p class="tags">Burgers, salades, patat</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

</body>
</html>
