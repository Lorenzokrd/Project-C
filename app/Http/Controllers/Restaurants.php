<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\DeliveryTimes;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\RestaurantRating;

class Restaurants extends Controller
{
    function save(Request $req){

        try {
            $restaurant = new Restaurant;
            $restaurant->user_id = $req->userId;
            $restaurant->name = $req->name;
            $restaurant->email = $req->email;
            $restaurant->min_order_price = str_replace(',', '.', $req->minOrderPrice);
            $restaurant->delivery_price = str_replace(',', '.', $req->deliveryPrice);
            $restaurant->website = $req->website;
            $restaurant->city = $req->city;
            $restaurant->street = $req->street;
            $restaurant->zip_code = $req->zipCode;
            if(!$req->restaurantImage == null) {
                $restaurant->image = $req->file('restaurantImage')->store('public');
            }
            $restaurant->save();
            return redirect('register-restaurant/success');
        } catch(\Exception $e){
            return redirect('register-restaurant')->with('exception', 'Aanmelding is niet succesvol verwerkt!');
        }
    }

    function update(Request $req){

        try {
            $restaurant = Restaurant::where('id', $req->restaurantId)->first();
            $restaurant->name = $req->name;
            $restaurant->email = $req->email;
            $restaurant->min_order_price = str_replace(',', '.', $req->minOrderPrice);
            $restaurant->delivery_price = str_replace(',', '.', $req->deliveryPrice);
            $restaurant->website = $req->website;
            $restaurant->city = $req->city;
            $restaurant->avg_delivery_time = $req->averageDeliveryTime;
            $restaurant->street = $req->street;
            $restaurant->zip_code = $req->zipCode;
            if(file_exists($req->file('restaurantImage'))){
                $oldImage= $restaurant->image;
                $restaurant->image = $req->file('restaurantImage')->store('public');
                storage::delete($oldImage);
            }
            $restaurant->save();
            return redirect('dashboard/settings')->with('success', 'Restaurant succesvol aangepast!');;
        } catch(\Exception $e){
            return redirect('dashboard/settings')->with('exception', 'Aanpassen gegevens is niet gelukt!');
        }
    }

    function read(){
        $restaurants = Restaurant::all();
        return view('dashboard/dashboard',['restaurants'=>$restaurants]);
    }

    function readSettings(){
        if(isset(\Auth::user()->id)) {
            $userId = \Auth::user()->id;
        } else{
            return redirect('/');
        }
        $restaurant = Restaurant::where('user_id', $userId)->first();
        $deliveryTimes = DeliveryTimes::where('restaurant_id', $restaurant->id)->first();

        return view('dashboard.settings',['deliveryTimes'=>$deliveryTimes,'restaurant'=>$restaurant]);
    }

    function approve(Request $req){
        try {
            $restaurant=Restaurant::find($req->restaurantId);
            $restaurant->approved = 1;
            $restaurant->save();
            $user=User::find($req->userId);
            $user->role = 2;
            $user->save();

            $deliveryTimes = new DeliveryTimes;
            $deliveryTimes->restaurant_id = $req->restaurantId;
            $deliveryTimes->save();
            return redirect('dashboard')->with('success', 'Restaurant goedgekeurd!');
        } catch(\Exception $e){
            return redirect('dashboard')->with('exception', 'Goedkeuren restaurant mislukt!');
        }
    }

    function fetch(){
        $restaurants = DB::table('restaurant')
        ->leftJoin('restaurant_rating','restaurant.id','=','restaurant_rating.restaurant_id')
        ->select('restaurant.*',DB::raw('restaurant_rating.restaurant_id,avg(restaurant_rating.food_score+restaurant_rating.delivery_score)/2 as rating'))
        ->orderBy('min_order_price','asc')->
        groupBy('restaurant_rating.restaurant_id','restaurant.name','restaurant.id',
        'restaurant.user_id','restaurant.email','restaurant.min_order_price',
        'restaurant.delivery_price','restaurant.avg_delivery_time',
        'restaurant.website','restaurant.city','restaurant.street',
        'restaurant.zip_code','restaurant.image','restaurant.approved')->get();
        return view('/index',['restaurants'=>$restaurants]);
    }

    function orderByPriceDesc(){
        $restaurants = DB::table('restaurant')
        ->leftJoin('restaurant_rating','restaurant.id','=','restaurant_rating.restaurant_id')
        ->select('restaurant.*',DB::raw('restaurant_rating.restaurant_id,avg(restaurant_rating.food_score+restaurant_rating.delivery_score)/2 as rating'))
        ->orderBy('min_order_price','desc')->
        groupBy('restaurant_rating.restaurant_id','restaurant.name','restaurant.id',
        'restaurant.user_id','restaurant.email','restaurant.min_order_price',
        'restaurant.delivery_price','restaurant.avg_delivery_time',
        'restaurant.website','restaurant.city','restaurant.street',
        'restaurant.zip_code','restaurant.image','restaurant.approved')->get();
        return view('/index',['restaurants'=>$restaurants]);
    }

    function orderByPriceAsc(){
        $restaurants = DB::table('restaurant')
        ->leftJoin('restaurant_rating','restaurant.id','=','restaurant_rating.restaurant_id')
        ->select('restaurant.*',DB::raw('restaurant_rating.restaurant_id,avg(restaurant_rating.food_score+restaurant_rating.delivery_score)/2 as rating'))
        ->orderBy('min_order_price','asc')->
        groupBy('restaurant_rating.restaurant_id','restaurant.name','restaurant.id',
        'restaurant.user_id','restaurant.email','restaurant.min_order_price',
        'restaurant.delivery_price','restaurant.avg_delivery_time',
        'restaurant.website','restaurant.city','restaurant.street',
        'restaurant.zip_code','restaurant.image','restaurant.approved')->get();
        return view('/index',['restaurants'=>$restaurants]);
    }

    function orderByDeliveryTime(){
        $restaurants = DB::table('restaurant')
        ->leftJoin('restaurant_rating','restaurant.id','=','restaurant_rating.restaurant_id')
        ->select('restaurant.*',DB::raw('restaurant_rating.restaurant_id,avg(restaurant_rating.food_score+restaurant_rating.delivery_score)/2 as rating'))
        ->orderBy('restaurant.avg_delivery_time','asc')->
        groupBy('restaurant_rating.restaurant_id','restaurant.name','restaurant.id',
        'restaurant.user_id','restaurant.email','restaurant.min_order_price',
        'restaurant.delivery_price','restaurant.avg_delivery_time',
        'restaurant.website','restaurant.city','restaurant.street',
        'restaurant.zip_code','restaurant.image','restaurant.approved')->get();

        return view('/index',['restaurants'=>$restaurants]);
    }

    function orderByRating(){
        $restaurants = DB::table('restaurant')
        ->leftJoin('restaurant_rating','restaurant.id','=','restaurant_rating.restaurant_id')
        ->select('restaurant.*',DB::raw('restaurant_rating.restaurant_id,avg(restaurant_rating.food_score+restaurant_rating.delivery_score)/2 as rating'))
        ->orderBy('rating','desc')->
        groupBy('restaurant_rating.restaurant_id','restaurant.name','restaurant.id',
        'restaurant.user_id','restaurant.email','restaurant.min_order_price',
        'restaurant.delivery_price','restaurant.avg_delivery_time',
        'restaurant.website','restaurant.city','restaurant.street',
        'restaurant.zip_code','restaurant.image','restaurant.approved')->get();
        return view('/index',['restaurants'=>$restaurants]);
    }

    function rateRestaurant(Request $req,$restaurantId){
        $currentUserOrders = Order::where([['user_id','=',\Auth::user()->id],
        ['restaurant_id','=',$restaurantId]])->get();
        if(count($currentUserOrders) > 0){
            $rating = new RestaurantRating;
            $rating->restaurant_id = $restaurantId;
            $rating->food_score = $req->foodScore;
            $rating->delivery_score = $req->deliveryScore;
            $rating->comment = $req->reviewComment;
            $rating->date = $req->reviewDate;
            $rating->save();
        }
    }

    function updateDeliveryTimes(Request $req){
        try {
            if(DeliveryTimes::where('restaurant_id', $req->restaurantId)->first()){
                $deliveryTimes = DeliveryTimes::where('restaurant_id', $req->restaurantId)->first();
            } else {
                $deliveryTimes = new DeliveryTimes;
            }
            $deliveryTimes->restaurant_id = $req->restaurantId;
            $deliveryTimes->monday = $req->monday;
            $deliveryTimes->tuesday = $req->tuesday;
            $deliveryTimes->wednesday = $req->wednesday;
            $deliveryTimes->thursday = $req->thursday;
            $deliveryTimes->friday = $req->friday;
            $deliveryTimes->saturday = $req->saturday;
            $deliveryTimes->sunday = $req->sunday;
            $deliveryTimes->save();
            return redirect('dashboard/settings')->with('success', 'Openingstijden succesvol aangepast');;
        } catch(\Exception $e){
            return redirect('dashboard/settings')->with('exception', 'Openingstijden niet succesvol aangepast!');
        }
    }
}
