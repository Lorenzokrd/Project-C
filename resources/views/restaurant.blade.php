@include('include.navbar')

<div id="restaurant-banner" class="restaurant-banner" style="background-image: url('{{URL('/images/restaurant-banner.png')}}');">
    <div class="restaurant-title">
        {{$info["restaurant"]->name}} <img src="https://i.imgur.com/HnD1EGv.png" style="width:120px;margin-bottom:3px;">
    </div>
</div>
<div class="category-menu" id="category-menu">
    @foreach($categories as $category)
    <a href="#menu{{$category['id']}}"><span class="category-item">{{$category["name"]}}</span></a>
    @endforeach
</div>
<div class="restaurant-container">
    <div class="restaurant-products">
        @foreach($categories as $category)
        <div class="category-title" id="menu{{$category['id']}}">
            <h2>{{$category["name"]}}</h2>
        </div>
        <div class="row">
            @foreach($info["products"] as $product)
            @if($category["id"] == $product["category"])
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

                <div class="product-buttons">
                    <!-- <a  onclick="event.stopPropagation();"> -->
                        <i class="far fa-question-circle" data-toggle="modal" href="#myModal"></i>
                    <!-- </a> -->
                    <i class="fas fa-plus-square"></i>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endforeach

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

<!-- Modals -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
