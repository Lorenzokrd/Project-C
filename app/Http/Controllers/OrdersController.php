<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Order;
use App\Orders;
use App\Restaurant;
use App\Product;

class OrdersController extends Controller
{
    function createOrder(Request $req,$restaurantName){
        if(\Auth::user() != null){
            $Order = new Order;
            $Order->user_id = \Auth::user()->id;
            $Order->restaurant_id = Restaurant::where('name',$restaurantName)->first()->id;
            $Order->save();
            foreach(Session::get($restaurantName)->products as $item){
                $orderedItems = new Orders;
                $orderedItems->order_id = $Order->id;
                $orderedItems->product_id = $item['product']['id'];
                $orderedItems->quantity = $item['quantity'];
                $orderedItems->save();
            }
        }
        else{
            return redirect('/login');
        }

    }

    function read(){
        $index=0;
        $restaurantorders = array();
        $orders = null;
        $orderedProducts = array();
        $userId = \Auth::user()->id;
        $restaurantId = Restaurant::where('user_id',$userId)->first()->id;
        $order = Order::where('restaurant_id',$restaurantId)->get();

        foreach($order as $item3){
            $orders[]=Orders::where('order_id',$item3->id)->get();
            foreach($order as $item){
                foreach($orders as $item2){
                    $orderedProducts = [$item2[$index]["id"]=>['productName'=>Product::find($item2[$index]["product_id"])->name, 'quantity'=>$item2[$index]["quantity"],'price'=>Product::find($item2[$index]["product_id"])->price*$item2[$index]["quantity"]]]; 
                    if($item->id == $item2[$index]["order_id"]){
                        $restaurantorders += [$item->id=>['products'=>[$orderedProducts],'userId'=>$item->user_id]];
                    }
                }     
            }   
        }

        return $restaurantorders;
    }
}
