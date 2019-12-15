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
            @foreach($tags as $tag)
            @if($tag->tagNumber == 0)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id={{$tag->id}} disabled>
                <label class="tag-check custom-control-label" for={{$tag->id}}>{{$tag->name}} ({{$tag->tagNumber}})</label>
            </div>
            @else
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id={{$tag->id}}>
                <label class="tag-input custom-control-label" for={{$tag->id}}>{{$tag->name}} ({{$tag->tagNumber}})</label>
            </div>
            @endif
            @endforeach
            <br><br>
            <p style="font-weight:700">Min. Bestelbedrag</p>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="radio0" name="price" value = "0">
                <label class="priceInput custom-control-label" for="radio0" value=0>Geen voorkeur</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="radio1" name="price" value="5">
                <label class="priceInput custom-control-label" for="radio1" value=5>Vanaf €5,00</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="radio2" name="price" value="10">
                <label class="priceInput custom-control-label" for="radio2" value=10>Vanaf €10,00</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="radio3" name="price" value = "15">
                <label class="priceInput custom-control-label" for="radio3" value=15>Vanaf €15,00</label>
            </div>
        </div>
        <div id="restaurants-overview" class="col-lg-10">
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
            <div  class="row">
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
        </div>
    
    </div>
</div>
<script>
$(document).ready(function(){
    var selectedTags = [];
    var lastChosenMinPrice = 0;
    $("#radio0").prop("checked",true);
    $(".tag-input").click(function(){
        if(isChosen($(this).attr("for"),selectedTags)){
            removeTag($(this).attr("for"),selectedTags);
            $(this). prop("checked", false);
            $.ajax({
                type:"get",
                url: "",
                data: {chosenTags: selectedTags, chosenTagsLength: selectedTags.length,minPrice: lastChosenMinPrice,_token: '{{csrf_token()}}' },
                success: function(response){
                    console.log("succeeded");
                    $("#restaurants-overview").html(response);
                },
                error: function(data){
                    console.log("error");
                }
            });
        }
        else{
            selectedTags.push($(this).attr("for"));
            $.ajax({
                type:"get",
                url: "",
                data: {chosenTags: selectedTags, chosenTagsLength: selectedTags,minPrice: lastChosenMinPrice ,_token: '{{csrf_token()}}' },
                success: function(response){
                    console.log("succeeded");
                    $("#restaurants-overview").html(response);
                },
                error: function(data){
                    console.log(data);
                    console.log("error");
                }
                });
        }
    })
    $(".priceInput").click(function(){
        lastChosenMinPrice = $(this).attr("value");
        $.ajax({
                type:"get",
                url: "",
                data: {chosenTags: selectedTags, chosenTagsLength: selectedTags.length,minPrice: $(this).attr("value"),_token: '{{csrf_token()}}' },
                success: function(response){
                    console.log("succeeded");
                    $("#restaurants-overview").html(response);
                },
                error: function(data){
                    console.log(data)
                    console.log("error");
                }
            });
    })
    function isChosen(item,array){
        for(var i =0; i<array.length;i++){
            if(item == array[i]){
                return true;
            }
        }
    }
    function removeTag(tagToRemove,TagsArray){
        TagsArray.splice(jQuery.inArray(tagToRemove, TagsArray),1);
    }
})
</script>
</body>

</html>
