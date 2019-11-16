<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Order;
use App\Orders;

class OrdersController extends Controller
{
    function createOrder(Request $req){
        var_dump(Session::get($info["restaurant"]->name)->products);
    }
}
