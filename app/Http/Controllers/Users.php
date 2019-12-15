<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facad;
use Illuminate\Support\Facades\Storage;
use App\Order;
use App\Orders;
use App\Restaurant;
use App\Product;
use Auth;
use App\Cart;

class Users extends Controller
{
    //
    function update(Request $req){
      $user = User::where('id', \Auth::user()->id)->first();
      $user->name=$req->name;
      $user->email=$req->email;
      $user->save();
      return redirect('user');
    }

    function read(){
        $index=0;
        $restaurantorders = array();
        $orders = array();
        $orderedProducts = array();
        $userId =\Auth::user()->id;
        $order = Order::where('user_id',$userId)->get();
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
                        $restaurantorders += [$item->id=>['products'=>$product,'userId'=>$item->user_id,'status'=>$item->status,'created-at'=>$item->created_at,'restaurantname'=>Restaurant::find($item->restaurant_id)->name]];
                    }
                }
            }
        }

        return view('/user',['orders'=>array_reverse($restaurantorders,true)]);
    }
}
