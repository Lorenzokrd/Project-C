@include('include.navbar')

<h1>Gebruiksgegevens aanmaken</h1>
<div class="row">
    <div class="col-lg-6">
        <form action="submitGebruiksgegevens" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gebruiksAdress">Gebruiksgegevens adress</label>
                <input type="input" class="form-control" name="gebruiksAdress" placeholder="gebruiksgegevens adress">
            </div>
            <div class="form-group">
                <label for="gebruiksWoonplaats">Gebruiksgegevens woonplaats</label>
                <input type="input" class="form-control" name="gebruiksWoonplaats" placeholder="gebruiksgegevens woonplaats">
            </div>
            <div class="form-group">
                <label for="gebruiksPostcode">Gebruiksgegevens postcode</label>
                <input type="input" class="form-control" name="gebruiksPostcode" placeholder="gebruiksgegevens postcode">
            </div>
            <div class="form-group">
                <label for="gebruiksNummer">Gebruiksgegevens telefoonnummer</label>
                <input type="input" class="form-control" name="gebruiksNummer" placeholder="gebruiksgegevens telefoonnummer">
            </div>
            
            <input type="hidden" name="userId" value="<?php echo Auth::user()->id ?>">
            <button type="submit" class="btn btn-primary">Gebruiksgegevens aanmaken</button>
        </div>
        <div class="col-lg-6">
        </div>
    </form>
</div>

@include('include.dashboard.footer')