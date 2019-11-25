@include('include.dashboard.header')

<script>
jQuery(function($) {
    setTimeout(function() {
        $('#popup').fadeOut('slow');
    }, 3000);
});
</script>

@if(session('success'))
    <div class="success popup" id="popup"><i class="far fa-check-circle"></i> {{session('success')}}</div>
@elseif(session('exception'))
    <div class="exception popup" id="popup"><i class="far fa-check-circle"></i> {{session('exception')}}</div>
@endif

<h1>Categorieën</h1>
<div class="row">
    <div class="col-lg-4">
        <form action="submitCategory" method="POST">
            @csrf
          <div class="form-group">
            <input type="text" name="categoryName" class="form-control" placeholder="Categorie naam">
          </div>
          <input type="hidden" name="userId" value="<?php echo Auth::user()->id ?>">
          <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>
</div>

@include('include.dashboard.footer')
