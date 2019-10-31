@include('include.navbar')

<h1>Gebruiksgegevens Aanpassen</h1>
<div class="row">
    <div class="col-lg-5">
        <form action="editGebruiksgegeven" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gebruiksadress">Gebruiksgegevens adress</label>
                <input type="input" class="form-control" name="gebruiksadress" placeholder="gebruiksgegevens adress" value="{{$gebruiksgegevens ?? ''->adress}}">
            </div>
            <div class="form-group">
                <label for="gebruikswoonplaats">Gebruiksgegevens woonplaats</label>
                <input type="number" class="form-control" name="gebruikswoonplaats" placeholder="gebruiksgegevens woonplaats" value="{{$gebruiksgegevens ?? ''->woonplaats}}">
            </div>
            <div class="form-group">
                <label for="gebruikspostcode">Gebruiksgegevens postcode</label>
                <input type="input" class="form-control" name="gebruikspostcode" placeholder="gebruiksgegevens postcode" value="{{$gebruiksgegevens ?? ''->postcode}}">
            </div>
            <div class="form-group">
                <label for="gebruiksnummer">Gebruiksgegevens adress</label>
                <input type="input" class="form-control" name="gebruiksnummer" placeholder="gebruiksgegevens telefoonnummer" value="{{$gebruiksgegevens ?? ''->telefoonnummer}}">
            </div>
            
            <input type="hidden" name="gebruiksgegevensId" value="{{$gebruiksgegevens ?? ''->id}}">
            <button type="submit" class="btn btn-primary">Gebruiksgegevens aanpassen</button>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
            @csrf
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button">Allergie toevoegen</button>
                    </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </form>
</div>

@include('include.dashboard.footer')