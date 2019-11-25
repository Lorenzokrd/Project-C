<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Order;
use App\Orders;
use App\Restaurant;
use App\Product;
use Auth;
use App\Cart;

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
        $orders = array();
        $orderedProducts = array();
        $userId = \Auth::user()->id;
        $restaurantId = Restaurant::where('user_id',$userId)->first()->id;
        $order = Order::where('restaurant_id',$restaurantId)->get();
        foreach($order as $item3){
            $orders[]=Orders::where('order_id',$item3->id)->get();
        }

        foreach($orders as $item2){
            for($i = 0; $i<count($item2);$i++){
                $item2[$i]["productName"] = Product::find($item2[$i]["product_id"])->name;
                $item2[$i]["price"] = Product::find($item2[$i]["product_id"])->price*$item2[$i]["quantity"];
                unset($item2[$i]['id']);
                unset($item2[$i]['product_id']);
            }
        }

        foreach($order as $item){
            foreach($orders as $product){
                for($i = 0; $i<count($product);$i++){
                    if($product[$i]["order_id"] == $item->id){
                        $restaurantorders += [$item->id=>['products'=>$product,'userId'=>$item->user_id]];
                    }
                }
            }
        }
        
        return view('/dashboard/orders',['orders'=>$restaurantorders]);
    }
    function updateStatus(Request $req){
        $order= Order::find($req->orderId);
        $order->status = $req->orderStatus;
        $order->save();
    }
}