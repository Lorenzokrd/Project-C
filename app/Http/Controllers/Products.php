<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;

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
        return view('dashboard/products',['products'=>$products]);

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
    
    function getProducts($restaurantName,$restaurantId){
        $product = Product::where('restaurant_id', $restaurantId)->get();
        return $product;
    }

}
