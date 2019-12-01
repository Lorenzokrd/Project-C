<?php
if(Auth::user() == null){
header("Location: /login");
die();
} elseif (Auth::user()->role > 2) {
header("Location: /");
die();
}
 ?>
<!DOCTYPE html>
<html style="height:100%">
<head>
<title>Dashboard restaurant - Rotterdambezorgd.nl</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<script src="https://kit.fontawesome.com/1cde44e559.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script>
//Get url and adds active class based on url
jQuery(function($) {
     var url = window.location.href;
     url = url.substring(url.lastIndexOf("/") + 1);
     console.log(url);
     if(url === ''){
         $('#dashboard').addClass('active');
     } else {
         $('.sidebar-items li').each(function() {
             if (this.id === url) {
                 $(this).addClass('active');
             }
         })
     };
});
</script>

</head>
<body style="overflow:hidden;height:100%;background:#ececec">
<div class="sidebar">
    <img class="sidebar-logo clickable" src="{{URL('/images/logo.png')}}" alt="" onclick="window.location='/'">
    <div class="sidebar-main">
        <ul class="list-group sidebar-items">
          <li class="list-group-item" id="dashboard" onclick="window.location='http://localhost:8000/dashboard';"><i class="fas fa-chart-bar mr-1"></i>Dashboard</li>
          <li class="list-group-item" id="orders" onclick="window.location='http://localhost:8000/dashboard/orders';"><i class="fas fa-clipboard-list mr-2"></i>Bestellingen</li>
          <li class="list-group-item" id="products" onclick="window.location='http://localhost:8000/dashboard/products';"><i class="fas fa-utensils mr-2"></i>Producten</li>
          <li class="list-group-item" id="categories" onclick="window.location='http://localhost:8000/dashboard/categories';"><i class="fas fa-utensils mr-2"></i>Categorieën</li>
          <li class="list-group-item" id="settings" onclick="window.location='http://localhost:8000/dashboard/settings';"><i class="fas fa-cog mr-1"></i>Instellingen</li>
        </ul>
    </div>
</div>
<div class="content">
