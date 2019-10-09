@include('include.dashboard.header')

<script>
jQuery(function($) {
    setTimeout(function() {
        $('#success-popup').fadeOut('slow');
    }, 3000);
});
</script>

<div class="product-form" style="margin-bottom:100px;">
    @if(session('message'))
  <div class="success-popup" id="success-popup"><i class="far fa-check-circle"></i> {{session('message')}}</div>
    @endif
    <h1>Product toevoegen</h1>
    <div class="row">
        <div class="col-6">
            <form action="sumbitProduct" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Product naam</label>
                <input type="input" class="form-control" name="productName" aria-describedby="emailHelp" placeholder="Product naam">
            </div>
            <div class="form-group">
                <label for="productDesc">Product beschrijving</label>
                <input type="input" class="form-control" name="productDesc" placeholder="Product Beschrijving">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="productRating">
                <label class="form-check-label" for="productRating">Product beoordeling</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="productImage">Product foto</label>
                <input type="file" class="form-control" name="productImage">
            </div>
            <div class="form-group">
                <label for="productPrice">Product prijs</label>
                <input type="input" class="form-control" name="productPrice" placeholder="Product Prijs">
            </div>
            <input type="hidden" name="restaurantId" value="1">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Product aanmaken</button>
    </form>
</div>

<div class="products">
    <h1>Producten</h1>
    <table class="table table-striped">
      <thead class="thead-black">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Naam</th>
          <th scope="col">Beschrijving</th>
          <th scope="col">Prijs</th>
          <th scope="col">Foto</th>
          <th scope="col">Rating</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <th scope="row">{{$product->id}}</th>
          <td>{{$product->name}}</td>
          <td>{{$product->description}}</td>
          <td>{{$product->price}}</td>
          <td><img class="table-image" src="{{ asset('storage/'.str_replace('public/', '', $product->image)) }}" /></td>
          <td>{{$product->toggle_rating}}</td>
          <td style="width:100px;"><button type="button" class="btn btn-primary">Aanpassen</button></td>
          <form action="deleteProduct" method="POST">
              @csrf
              <input type="hidden" name="productId" value="{{$product->id}}">
              <input type="hidden" name="productImage" value="{{$product->image}}">
              <td style="width:100px;"><button type="submit" class="btn btn-danger">Verwijderen</button></td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>

@include('include.dashboard.footer')
