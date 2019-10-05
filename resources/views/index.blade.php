<!DOCTYPE html>
<html>
@include('include.navbar')

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
        </div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/#';return false;">
                    <div class="restaurant-card" style="background-image:url('https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500');">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> Burger me</p>
                        </div>
                        <div class="status restaurant-status-recommended">
                            <p>Aanbevolen voor jou</p>
                        </div>
                        <div class="restaurant-info">
                            <img class="restaurant-score" src="https://cdn.discordapp.com/attachments/206957264408412162/630042617047941132/image_1.png">
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €20,00</p>
                            <p class="time"><i class="far fa-clock"></i> 40 min</p>
                            <p class="tags">Burgers, salades, patat</p>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/#';return false;">
                    <div class="restaurant-card" style="background-image:url('https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-1.2.1&w=1000&q=80');">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> Pannenkoekenhuis Dutch Diner</p>
                        </div>
                        <div class="restaurant-info">
                            <img class="restaurant-score" src="https://cdn.discordapp.com/attachments/206957264408412162/630042617047941132/image_1.png">
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €13,00</p>
                            <p class="time"><i class="far fa-clock"></i> 30 min</p>
                            <p class="tags">Pannenkoeken, poffertjes, ontbijt</p>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/#';return false;">
                    <div class="restaurant-card" style="background-image:url('https://d1ralsognjng37.cloudfront.net/b3354ed7-9661-4ae5-85bc-9b7414d176a3');">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> Poke Bowls Byns by Han</p>
                        </div>
                        <div class="restaurant-info">
                            <img class="restaurant-score" src="https://cdn.discordapp.com/attachments/206957264408412162/630042617047941132/image_1.png">
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €10,00</p>
                            <p class="time"><i class="far fa-clock"></i> 55 min</p>
                            <p class="tags">Poke bowls, salades, shakes</p>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/#';return false;">
                    <div class="restaurant-card" style="background-image:url('https://www.bbcgoodfood.com/sites/default/files/recipe-collections/collection-image/2013/05/sirloin_steak.jpg');background-position:center;">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> Steakhouse Pizzeria Bergo</p>
                        </div>
                        <div class="restaurant-info">
                            <img class="restaurant-score" src="https://cdn.discordapp.com/attachments/206957264408412162/630042617047941132/image_1.png">
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €11,00</p>
                            <p class="time"><i class="far fa-clock"></i> 45 min</p>
                            <p class="tags">Pizza, fingerfood</p>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item" onclick="document.location='/#';return false;">
                    <div class="restaurant-card" style="background-image:url('https://www.thuisbezorgd.nl/foodwiki/uploads/2017/05/sushi-3-1080x960.jpg');background-position:center;">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> Sushito | Magna Plaza</p>
                        </div>
                        <div class="restaurant-info">
                            <img class="restaurant-score" src="https://cdn.discordapp.com/attachments/206957264408412162/630042617047941132/image_1.png">
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €11,00</p>
                            <p class="time"><i class="far fa-clock"></i> 30 min</p>
                            <p class="tags">Sushi, soep, vis</p>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-6 col-lg-4 restaurant-grid-item " onclick="document.location='/#';return false;">
                    <div class="restaurant-card" style="background-image:url('https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/gettyimages-957724994-1558091653.jpg?crop=0.670xw:1.00xh;0.167xw,0&resize=640:*');background-position:center;">
                        <div class="restaurant-name">
                            <p><i class="far fa-star" aria-hidden="true"></i> Tomo Sushi</p>
                        </div>
                        <div class="restaurant-status">
                            <div class="status restaurant-status-closed">
                                <p>Gesloten</p>
                            </div>
                        </div>
                        <div class="restaurant-info">
                            <img class="restaurant-score" src="https://cdn.discordapp.com/attachments/206957264408412162/630042617047941132/image_1.png">
                            <p class="price"><i class="fas fa-shopping-basket"></i> Min. €15,00</p>
                            <p class="time"><i class="far fa-clock"></i> 25 min</p>
                            <p class="tags">Sushi, soep, vis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
