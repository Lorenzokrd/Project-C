@include('include.navbar')
<script>
jQuery(function($) {
    setTimeout(function() {
        $('#popup').fadeOut('slow');
    }, 3000);
});
</script>

<div class="product-form" style="margin-bottom:100px;position:relative">
    @if(session('success'))
        <div class="success popup" id="popup"><i class="far fa-check-circle"></i> {{session('success')}}</div>
    @elseif(session('exception'))
        <div class="exception popup" id="popup"><i class="far fa-check-circle"></i> {{session('exception')}}</div>
    @endif

<button onclick="window.location='http://localhost:8000/dashboard/gebruiksgegevens';" class="btn btn-primary" style="float:right;">Gebruikgegevens aanmaken</button>
</div class="Gebruiksgegevens">

<div class="products">
    <h1>Gebruiksgegevens</h1>
    <table class="table table-striped">
      <thead class="thead-black">
        <tr>
          <th scope="col">Adress</th>
          <th scope="col">Woonplaats</th>
          <th scope="col">Postcode</th>
          <th scope="col">Telefoonnummer</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($errors as $gebruiksgegevens)
        <tr>
          <th scope="row">{{$gebruiksgegevens->id}}</th>
          <td>{{$gebruiksgegevens->Adress}}</td>
          <td>{{$gebruiksgegevens->Woonplaats}}</td>
          <td>{{$gebruiksgegevens->Postcode}}</td>
          <td>{{$gebruiksgegevens->Telefoonnummer}}</td>
          <form action="findGebruiksgegevens" method="GET">
              @csrf
              <input type="hidden" name="gebruiksgegevensId" value="{{$gebruiksgegevens->id}}">
              <td style="width:100px;"><button type="submit" class="btn btn-primary" >Aanpassen</button></td>
          </form>
          <form action="deletegebruiksgegevens" method="POST">
              @csrf
              <input type="hidden" name="gebruiksgegevensId" value="{{$gebruiksgegevens->id}}">
              <td style="width:100px;"><button type="submit" class="btn btn-danger">Verwijderen</button></td>
          </form>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
@include('include.dashboard.footer')