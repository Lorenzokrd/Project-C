<!DOCTYPE html>
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
    <div class="row">
            <div class="filters-top">

                <div class="filter-btn dropdown float-right">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Prijs
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/order/price/desc">Hoog - laag</a>
                    <a class="dropdown-item" href="/order/price/asc">Laag - hoog</a>
                    </div>
                </div>
                <div class="filter-btn dropdown float-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Soorteer op
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/order/delivery">Bezorgtijd</a>
                        <a class="dropdown-item" href="/order/rating">Beoordeling</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="restaurants-overview" class="row">
            @foreach ($restaurants as $restaurant)
            @if($restaurant->approved == 1)
            <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/{{$restaurant->name}}';">
                    <div class="restaurant-card" style="background-image:url({{ asset('storage/'.str_replace('public/', '', $restaurant->image)) }});">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> {{$restaurant->name}}</p>
                        </div>
                        @if($restaurant->recommended == 1)
                        <div class="status restaurant-status-recommended">
                                <p>Aanbevolen voor jou</p>
                        </div>
                        @endif
                        <div class="restaurant-info">
                            <div class="restaurant-score"><?php Makestars($restaurant->rating) ?></div>
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €{{ str_replace('.', ',', $restaurant->min_order_price)}}</p>
                            @if($restaurant->avg_delivery_time)
                            <p class="time"><i class="far fa-clock"></i> {{$restaurant->avg_delivery_time}} min</p>
                            @else
                            <p class="time"><i class="far fa-clock"></i> 30 min</p>
                            @endif
                            <p class="tags">Burgers, salades, patat</p>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach

        </div>
        {{$restaurants->links()}}