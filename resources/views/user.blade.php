@include('include.navbar')
@extends('layouts.app')


<div class="container">
	<div class="row" style="padding-top: 36px;">
		<div class="col-md-3 ">
    <div class="list-group" id="list-tab" role="tablist" style="background-color: green; box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.37); border-radius: 10px;">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home" style="font-weight:600;color:#FAF6D5 !important">Gebruiker</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#orders-profile" role="tab" aria-controls="profile" style="font-weight:600;color:#FAF6D5 !important">Bestellingen</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages" style="font-weight:600;color:#FAF6D5 !important">Adressen</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings" style="font-weight:600;color:#FAF6D5 !important">Settings</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="col-md-9">
    		    <div class="card">
    		        <div class="card-body">
    		            <div class="row">
    		                <div class="col-md-12">
    		                    <h4>Gebruikersgegevens</h4>
    		                    <hr>
    		                </div>
    		            </div>
    		            <div class="row">
    		                <div class="col-md-12">
    		                    <form action="user/update" method="post" enctype="multipart/form-data">
								@csrf
                                  <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Naam</label>
                                    <div class="col-8">
                                      <input id="username" name="name" placeholder="name" value="{{ Auth::user()->name }}" class="form-control here" required="required" type="text">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                      <input id="email" name="email" placeholder="email" value="{{ Auth::user()->email }}" class="form-control here" required="required" type="text">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="offset-4 col-8">
                                      <button name="submit" type="submit" class="btn btn-primary">Profiel wijzigen</button>
                                    </div>
                                  </div>
                                </form>
    		                </div>
    		            </div>

    		        </div>
    		    </div>
    		</div>
      </div>
      <div class="tab-pane fade" id="orders-profile" role="tabpanel" aria-labelledby="list-profile-list">

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
				                <span class="order-title">{{$order['restaurantname']}}</span>
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
												<div class="order-status-user">
															Status bestelling: <span class="float-right">{{$order['status']}}</span>
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
												<div class=review-button-user>
													<button type="button" name="review-button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#userReviewModal">Beoordeel Bestelling</button>
												</div>
												<!-- Modal User Review -->
												<div class="modal fade" id="userReviewModal" tabindex="-1" role="dialog" aria-labelledby="userReviewModalCenterTitle" aria-hidden="true">
												  <div class="modal-dialog modal-dialog-centered" role="document">
												    <div class="modal-content">
												      <div class="modal-header">
												        <h5 class="modal-title" id="userReviewModalCenterTitle">Beoordeel uw bestelling van {{date("d F Y, H:i", strtotime($order['created-at']))}} bij {{$order['restaurantname']}}</h5>
												        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												          <span aria-hidden="true">&times;</span>
												        </button>
												      </div>
												      <div class="modal-body">
																<div class="container">
																 <div class="rate">
																    <input type="radio" id="star5" name="rate" value="5" />
																    <label for="star5" title="text">5 stars</label>
																    <input type="radio" id="star4" name="rate" value="4" />
																    <label for="star4" title="text">4 stars</label>
																    <input type="radio" id="star3" name="rate" value="3" />
																    <label for="star3" title="text">3 stars</label>
																    <input type="radio" id="star2" name="rate" value="2" />
																    <label for="star2" title="text">2 stars</label>
																    <input type="radio" id="star1" name="rate" value="1" />
																    <label for="star1" title="text">1 star</label>
																  </div>
																</div>
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-primary">Beoordeel Bestelling</button>
												      </div>
												    </div>
												  </div>
												</div>

				            </div>
				        </div>
				    </div>
				@endforeach
				</div>
      </div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
    </div>
  </div>
  </div>
</div>

</body>
</html>
