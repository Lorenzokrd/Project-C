<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;

class Restaurants extends Controller
{
    function save(Request $req){
        $restaurant = new Restaurant;

        $data = $req;

        foreach ($data as $key => $value) {
            if($value == null){
                return redirect('register-restaurant')->with('exception', 'Niet alle velden zijn ingevuld!');
            }
        }

        try {
            $restaurant->user_id = $req->userId;
            $restaurant->name = $req->name;
            $restaurant->email = $req->email;
            $restaurant->min_order_price = $req->minOrderPrice;
            $restaurant->delivery_price = $req->deliveryPrice;
            $restaurant->website = $req->website;
            $restaurant->city = $req->city;
            $restaurant->street = $req->street;
            $restaurant->zip_code = $req->zipCode;
            $restaurant->save();
            return redirect('register-restaurant/success');
        } catch(\Exception $e){
            return redirect('register-restaurant')->with('exception', 'Aanmelding is niet succesvol verwerkt!');
        }
    }

    function read(){
        $restaurants = Restaurant::all();
        return view('dashboard/dashboard',['restaurants'=>$restaurants]);
    }

    function approve(Request $req){
        try {
            $restaurant=Restaurant::find($req->id);
            $restaurant->approved = 1;
            $restaurant->save();
            return redirect('dashboard')->with('success', 'Restaurant goedgekeurd!');
        } catch(\Exception $e){
            return redirect('dashboard')->with('exception', 'Goedkeuren restaurant mislukt!');
        }

    }
}