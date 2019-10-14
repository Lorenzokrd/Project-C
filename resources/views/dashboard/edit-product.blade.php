
@include('include.dashboard.header')

<h1>Product Aanpassen</h1>
<div class="row">
    <div class="col-lg-5">
        <form action="editProduct" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Product naam</label>
                <input type="input" class="form-control" name="productName" placeholder="product naam" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="productPrice">Product prijs</label>
                <input type="number" class="form-control" name="productPrice" placeholder="product prijs" value="{{$product->price}}">
            </div>
            <div class="form-group">
                <label for="productDesc">Product Beschrijving</label>
                <input type="input" class="form-control productDescription" name="productDesc" placeholder="Beschrijving" value="{{$product->description}}">
            </div>
            <div class="form-group form-check">
                @if($product->productRating == null)
                <input type="checkbox" class="form-check-input" name="productRating" >
                <label class="form-check-label" for="productRating">Product beoordeling</label>
                @else
                <input type="checkbox" class="form-check-input" name="productRating" checked >
                <label class="form-check-label" for="productRating">Product beoordeling</label>
                @endif
            </div>
            <input type="hidden" name="restaurantId" value="1">
            <input type="hidden" name="productId" value="{{$product->id}}">
            <input type="hidden" name="productImage" value="{{$product->image}}">
            <button type="submit" class="btn btn-primary">Product aanpassen</button>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
            @csrf
            <div class="form-group">
                <label for="productImage">Product foto (optioneel)</label>
                <br>
            <input type="file" name="productImage">
            </div>
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button">Allergie toevoegen</button>
                    </span>
                    </div><!-- /input-group -->
                </div>
                <div class="panel-body">
                    <ul class="list-group" style="margin-top:5px;">
                        <li class="list-group-item listCustom">Cras justo odio</li>
                        <li class="list-group-item listCustom">Dapibus ac facilisis in</li>
                        <li class="list-group-item listCustom">Morbi leo risus</li>
                        <li class="list-group-item listCustom">Porta ac consectetur ac</li>
                        <li class="list-group-item listCustom">Vestibulum at eros</li>
                        <li class="list-group-item listCustom">Porta ac consectetur ac</li>
                        <li class="list-group-item listCustom">Vestibulum at eros</li>
                        <li class="list-group-item listCustom">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@include('include.dashboard.footer')
