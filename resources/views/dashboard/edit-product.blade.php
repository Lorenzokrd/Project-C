
@include('include.dashboard.header')

<h1>Product aanpassen</h1>
<div class="row">
    <div class="col-lg-6">
        <form action="update-product" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Product naam</label>
                <input type="input" class="form-control" name="productName" placeholder="Product naam" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="productPrice">Product prijs</label>
                <input type="input" class="form-control" name="productPrice" placeholder="Product prijs" value="{{$product->price}}">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="productRating" <?php if($product->toggle_rating == 1){ echo "checked"; } ?>
                <label class="form-check-label" for="productRating">Product beoordeling</label>

            </div>
            <input type="hidden" name="restaurantId" value="1">
            <input type="hidden" name="productId" value="{{$product->id}}">
            <input type="hidden" name="productImage" value="{{$product->image}}">
            <button type="submit" class="btn btn-primary">Product aanpassen</button>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="productImage">Product foto (optioneel)</label>
                <input type="file" class="form-control" name="productImage">
            </div>
            <div class="form-group" style="margin-top:-6px;">
                <label for="productDesc">Product Beschrijving</label>
                <input type="input" class="form-control" name="productDesc" placeholder="Beschrijving" value="{{$product->description}}">
            </div>
        </div>
    </form>
</div>

@include('include.dashboard.footer')
