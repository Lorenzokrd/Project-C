
@include('include.dashboard.header')

<h1>Product aanmaken</h1>
<div class="row">
    <div class="col-lg-6">
        <form action="sumbitProduct" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Product naam</label>
                <input type="input" class="form-control" name="productName" placeholder="Product naam">
            </div>
            <div class="form-group">
                <label for="productPrice">Product prijs</label>
                <input type="input" class="form-control" name="productPrice" placeholder="Product prijs">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="productRating" >
                <label class="form-check-label" for="productRating">Product beoordeling</label>
            </div>
            <input type="hidden" name="userId" value="<?php echo Auth::user()->id ?>">
            <button type="submit" class="btn btn-primary">Product aanmaken</button>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="productImage">Product foto (optioneel)</label>
                <input type="file" class="form-control" name="productImage">
            </div>
            <div class="form-group" style="margin-top:-6px;">
                <label for="productDesc">Product Beschrijving</label>
                <input type="input" class="form-control" name="productDesc" placeholder="Beschrijving">
            </div>
        </div>
    </form>
</div>

@include('include.dashboard.footer')
