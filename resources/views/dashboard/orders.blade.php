@include('include.dashboard.header')

<div class="row">
@foreach($orders as $key => $order)
@if($order['status'] != 'Bezorgd')
<?php
    $totalPrice = 0;
    foreach($order['products'] as $item) {
        $totalPrice += $item['price'];
    }
?>
    <div class="col-12 order-card">
        <div class="order-container">
            <div class="order-top">
                <span class="order-title"><i class="fas fa-clipboard-list"></i> Bestelling #{{$key}}</span>
                <span class="order-date float-right"><i class="fas fa-clock"></i> {{date("d F Y, H:i", strtotime($order['created-at']))}}</span>
            </div>
            <div class="order-content-left">
                <div class="order-items">
                    @foreach($order['products'] as $item)

                    <div class="order-item">
                        <span class="product-quantity">{{$item['quantity']}}x</span>
                        <span class="product-name">{{$item['productName']}}</span>
                        <span class="product-total float-right">€{{str_replace('.', ',', number_format($item['price'], 2, ',', ' '))}}</span>
                    </div>

                    @endforeach
                </div>
                <div class="order-total-price">
                    <span class="product-quantity">Totale prijs</span>
                    <span class="product-total float-right">€{{str_replace('.', ',', number_format($totalPrice, 2, ',', ' '))}}</span>
                </div>
            </div>
            <div class="order-content-right">
                <div class="order-item">
                    <span class="order-address">Plaats</span>
                    <span class="order-address float-right">Rotterdam</span>
                </div>
                <div class="order-item">
                    <span class="order-address">Straat</span>
                    <span class="order-address float-right">G.J. de Jonghweg 4</span>
                </div>
                <div class="order-item">
                    <span class="order-address">Postcode</span>
                    <span class="order-address float-right">3015 GG</span>
                </div>
                <div class="filter-btn dropdown order-delivered-btn">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      {{$order['status']}}
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                      <a class="dropdown-item" href="/updateStatus/{{'Wordt gemaakt'}}/{{$key}}">Wordt gemaakt</a>
                      <a class="dropdown-item" href="/updateStatus/{{'Onderweg'}}/{{$key}}">Onderweg</a>
                      <a class="dropdown-item" href="/updateStatus/{{'Bezorgd'}}/{{$key}}">Bezorgd</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
</div>



@include('include.dashboard.footer')
