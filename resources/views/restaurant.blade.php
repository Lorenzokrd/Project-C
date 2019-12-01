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

<div id="restaurant-banner" class="restaurant-banner" style="background-image: url('{{URL('/images/restaurant-banner.png')}}');">
    <div class="restaurant-title">
        {{$info["restaurant"]->name}}  <div class="restaurant-score"><?php Makestars($info["restaurant"]->rating) ?></div>
    </div>
</div>
<div class="category-menu" id="category-menu">
    <span class="category-item">Menu's</span>
    <span class="category-item">Broodjes</span>
    <span class="category-item">Bijgerechten</span>
    <span class="category-item">Sauzen</span>
    <span class="category-item">Extra</span>
</div>
<div class="restaurant-container">
    <div class="restaurant-products">
        <div class="row">

            @foreach ($info["products"] as $product)
            <div class="product-block" style="height:100px;" onclick="document.location='/add-to-cart/{{$info["restaurant"]->name}}/{{$product->id}}';">
                <div class="product-image" style="background-image:url({{ asset('storage/'.str_replace('public/', '', $product->image)) }});"></div>
                <div class="product-info">
                    <div class="product-title">{{$product->name}}</div>
                    <div class="product-desc">{{$product->description}}</div>
                    <span class="product-price">€{{str_replace('.', ',', $product->price)}}</span>
                    @if($product->toggle_rating == 1)
                    <img class="product-rating" src="https://i.imgur.com/HnD1EGv.png">
                    @endif
                </div>
                <div class="add-product"><i class="fas fa-plus-square"></i></div>
            </div>
            @endforeach

        </div>
    </div>
    <div id="cart" class="cart-container">
        <div class="cart">
            <div class="cart-title">
                <i class="fas fa-shopping-basket"></i> Winkelmand
            </div>
            <div class="cart-content">
                <div class="cart-items">
                    @if (Session::has($info["restaurant"]->name))
                    @foreach (Session::get($info["restaurant"]->name)->products as $item)
                    <div class="cart-item">
                        <span class="product-quantity">{{$item['quantity']}}x</span>
                        <span class="product-name">{{$item['product']['name']}}</span>
                        <span class="product-remove float-right" onclick="document.location='/remove-from-cart/{{$info["restaurant"]->name}}/{{$item['product']['id']}}';">
                            <i class="fas fa-minus-square"></i>
                        </span>
                        <span class="product-add float-right" onclick="document.location='/add-to-cart/{{$info["restaurant"]->name}}/{{$item['product']['id']}}';">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="product-total float-right">€{{str_replace('.', ',', number_format($item['price'], 2, ',', ' '))}}</span>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="cart-sum">
                    <div class="cart-delivery">
                        <span>Bezorgkosten</span>
                        <span class="float-right cart-delivery-price">€ {{str_replace('.', ',', number_format($info["restaurant"]->delivery_price, 2, ',', ' '))}}</span>
                    </div>
                    <div class="cart-total">
                        <span>Totaal</span>
                        @if (Session::has($info["restaurant"]->name))
                        @if (Session::get($info["restaurant"]->name)->totalPrice == 0)
                        <span class="float-right cart-total-price">€ {{str_replace('.', ',', number_format($info["restaurant"]->delivery_price, 2, ',', ' '))}}</span>
                        @else
                        <span class="float-right cart-total-price">€ {{str_replace('.', ',', number_format(Session::get($info["restaurant"]->name)->totalPrice, 2, ',', ' '))}}</span>
                        @endif
                        @else
                        <span class="float-right cart-total-price">€ {{$info["restaurant"]->delivery_price}}</span>
                        @endif
                    </div>
                </div>
            </div>
            @if (Session::has($info["restaurant"]->name))
            @if (Session::get($info["restaurant"]->name)->totalPrice - $info["restaurant"]->delivery_price < $info["restaurant"]->min_order_price )
            <span class="min-order-warning">De minimale bestelprijs is €{{$info["restaurant"]->min_order_price}}</span>
            @endif
            <button class="btn btn-primary cart-order-btn" onclick="document.location='/{{$info["restaurant"]->name}}/order';" <?php if(Session::get($info["restaurant"]->name)->totalPrice - $info["restaurant"]->delivery_price < $info["restaurant"]->min_order_price ) { echo "disabled"; } ?>>Bestellen</button>
            @else
            <span class="min-order-warning">De minimale bestelprijs is €{{$info["restaurant"]->min_order_price}}</span>
            <button class="btn btn-primary cart-order-btn" disabled>Bestellen</button>
            @endif
        </div>
    </div>
</div>

</body>
</html>
