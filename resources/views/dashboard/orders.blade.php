@include('include.dashboard.header')

<div class="row">
@foreach($orders as $key => $order)
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
                <span class="order-date float-right"><i class="fas fa-clock"></i> 16:12 - 17 November</span>
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
                <button class="btn btn-primary order-delivered-btn">Bezorgd</button>
            </div>
        </div>
    </div>
@endforeach
</div>



@include('include.dashboard.footer')
