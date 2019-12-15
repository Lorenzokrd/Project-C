<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Restaurant;
use App\Categories;
use App\DeliveryTimes;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Cart;
use Illuminate\Support\Facades\DB;
use App\RestaurantRating;

class Products extends Controller
{
    function save(Request $req){
        $product = new Product;

        $data = $req->except('productImage');

        foreach ($data as $key => $value) {
            if($value == null){
                return redirect('dashboard/products')->with('exception', 'Niet alle velden zijn ingevuld!');
            }
        }

        try {
            $restaurant=Restaurant::where('user_id', $req->userId)->first();
            $product->restaurant_id = $restaurant->id;
            $product->name = $req->productName;
            $product->description = $req->productDesc;
            if(!$req->productImage == null) {
                $product->image = $req->file('productImage')->store('public');
            }
            $product->category = $req->productCategory;
            $product->price = str_replace(',', '.', $req->productPrice);
            $product->toggle_rating = ($req->productRating == null) ? 0 : 1;
            $product->save();
            return redirect('dashboard/products')->with('success', 'Nieuw product is succesvol aangemaakt!');
        } catch(Exception $e){
            return redirect('dashboard/products')->with('exception', 'Product is unsuccesvol aangemaakt!');
        }
    }

    function read(){
        if(isset(\Auth::user()->id)) {
            $userId = \Auth::user()->id;
        } else{
            return redirect('/');
        }
        $restaurant = Restaurant::where('user_id', $userId)->first();
        $products = Product::where('restaurant_id', $restaurant->id)->get();

        return view('dashboard.products',['products'=>$products]);
    }

    function delete(Request $req){
        $product=Product::find($req->productId);
        $product->delete();
        Storage::delete($req->productImage);
        return redirect('dashboard/products')->with('success', 'Product is succesvol verwijderd!');
    }
    function update(Request $req){

        try {
            $product=Product::find($req->productId);
            $product->restaurant_id = 1;
            $product->name = $req->productName;
            $product->description = $req->productDesc;
            if(file_exists($req->file('productImage'))){
                $oldImage= $product->image;
                $product->image = $req->file('productImage')->store('public');
                storage::delete($oldImage);
            }
            $product->category = $req->productCategory;
            $product->price = str_replace(',', '.', $req->productPrice);
            $product->toggle_rating = ($req->productRating == null) ? 0 : 1;
            $product->save();
            return redirect('dashboard/products')->with('success', 'Product is succesvol bijgewerkt!');
        } catch(\Exception $e){
            return redirect('dashboard/products')->with('exception', 'Product is unsuccesvol aangemaakt!');
        }

    }
    function find(Request $req){
        $product=Product::find($req->productId);

        if(isset(\Auth::user()->id)) {
            $userId = \Auth::user()->id;
        } else{
            return redirect('/');
        }
        $restaurantId= Restaurant::where('user_id',$userId)->first()->id;
        $categories = Categories::where('restaurant_id',$restaurantId)->get();
        foreach($categories as $category){
            $category['name'] = Category::find($category['category_id'])->name;
            $category['id'] = Category::find($category['category_id'])->id;
        }

        return view('dashboard/edit-product',['product'=>$product,'categories'=>$categories]);
    }

    function getCategories($restaurantName){
        $restaurantId= Restaurant::where('name',$restaurantName)->first()->id;
        $categories = Categories::where('restaurant_id',$restaurantId)->get();
        foreach($categories as $category){
            $category['name'] = Category::find($category['category_id'])->name;
            $category['id'] = Category::find($category['category_id'])->id;
        }
        return $categories;
    }

    function getProducts($restaurantName){
        $restaurant =Restaurant::where('name',$restaurantName)->first();
        $restaurantrating = RestaurantRating::select(DB::raw('avg(restaurant_rating.food_score+restaurant_rating.delivery_score)/2 as rating'))->where('restaurant_id',1)->get();
        $restaurant['rating'] = $restaurantrating[0]->rating;
        $categories = $this->getCategories($restaurantName);
        $products = Product::where('restaurant_id', $restaurant->id)->get();
        $deliveryTimes = DeliveryTimes::where('restaurant_id', $restaurant->id)->first();
        $info = array("restaurant" => $restaurant, "products" => $products);
        return view('restaurant',['deliveryTimes'=>$deliveryTimes, 'info'=>$info, 'categories'=>$categories,"deliveryTime"=>$this->getDeliveryTimes(),"restaurant"=>$restaurant]);
    }

    function addToCart($restaurantName,$productId){
        $product = Product::find($productId);
        $restaurant = Restaurant::where('name',$restaurantName)->get();
        $prevCart = Session::has($restaurantName) ? Session::get($restaurantName) : null;
        $cart = new Cart($prevCart);
        $cart->addProduct($product,$product->id,$restaurant[0]->delivery_price);
        Session::put($restaurantName,$cart);
        return redirect($restaurantName);
    }

    function removeFromCart($restaurantName,$productId) {
        $prevCart = Session::has($restaurantName) ? Session::get($restaurantName) : null;
        $cart = new Cart($prevCart);
        $cart->removeProduct($productId);
        Session::put($restaurantName, $cart);
        return redirect($restaurantName);
    }

    function createAllergy(Request $req){
        $allergy = new Allergy;
        $allergy->name = $req->allergyName;
        $allergy->description = $req->allergyDesc;
        $allergy->save();
    }

    function addAllergyToProduct(Request $req){
        $productAllergy = new ProductAllergy;
        $productAllergy->product_id = $req->productId;
        $productAllergy->allergy_id = $req->allergyId;
        $productAllergy->save();
    }

    function rateProduct(Request $req){
        if(\Auth::user() != null){
            $userId = \Auth::user()->id;
            $userBigOrders = DB::table("order")->select('id')->where('user_id','=',$userId)->get();
            $userBigOrdersIds = [];
            foreach($userBigOrders as $userBigOrder){
                $userBigOrdersIds []= $userBigOrder->id;
            }
            $userOrderedProducts = DB::table("orders")->whereIn("order_id",$userBigOrdersIds)->get();
            $userOrderedProductsIds = [];
            foreach($userOrderedProducts as $userOrderedProduct){
                $userOrderedProductsIds []= $userOrderedProduct->product_id;
            }
            if(in_array($req->productId,$userOrderedProductsIds)){
                $productRating = new ProductRating;
                $productRating->product_id = $req->productId;
                $productRating->score = $req->ProductScore;
                $productRating->comment = $req->ProductComment;
                $productRating->date = $req->reviewDate;
                $productRating->save();
            }
        }
        else{
            return redirect('/login');
        }

    }

    function getDeliveryTimes(){
        $currentDay = date("l");

        $deliveryTimes = DB::table('delivery_times')->select('restaurant_id', $currentDay . " as day")->get();

        return $deliveryTimes;
    }
}
