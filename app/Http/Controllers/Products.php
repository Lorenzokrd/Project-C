<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Cart;
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
            $product->price = $req->productPrice;
            $product->toggle_rating = ($req->productRating == null) ? 0 : 1;
            $product->save();
            return redirect('dashboard/products')->with('success', 'Nieuw product is succesvol aangemaakt!');
        } catch(Exception $e){
            return redirect('dashboard/products')->with('exception', 'Product is unsuccesvol aangemaakt!');
        }
    }

    function read(){
        $userId = \Auth::user()->id;
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

        $data = $req->except('productImage');

        foreach ($data as $key => $value) {
            if($value == null){
                return redirect('dashboard/products')->with('exception', 'Niet alle velden zijn ingevuld!');
            }
        }
        try {
            $product=Product::find($req->productId);
            $product->restaurant_id = 1;
            $product->name = $req->productName;
            $product->description = $req->productDesc;
            if(!file_exists($req->file('productImage'))){

            }
            else{
                $oldImage= $product->image;
                $product->image = $req->file('productImage')->store('public');
                storage::delete($oldImage);
            }
            $product->price = $req->productPrice;
            $product->toggle_rating = ($req->productRating == null) ? 0 : 1;
            $product->save();
            return redirect('dashboard/products')->with('success', 'Product is succesvol bijgewerkt!');
        } catch(\Exception $e){
            return redirect('dashboard/products')->with('exception', 'Product is unsuccesvol aangemaakt!');
        }

    }
    function find(Request $req){
        $product=Product::find($req->productId);
        return view('dashboard/edit-product',['product'=>$product]);
    }

    function getProducts($restaurantName){
        $restaurant = Restaurant::where('name',$restaurantName)->first();
        $products = Product::where('restaurant_id', $restaurant->id)->get();
        $info = array("restaurant" => $restaurant, "products" => $products);
        return view('restaurant',['info'=>$info]);
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

}
