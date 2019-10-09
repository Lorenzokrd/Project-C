<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;

class Products extends Controller
{
    function save(Request $req){
        $product = new Product;
        $product->restaurant_id = 1;
        $product->name = $req->productName;
        $product->description = $req->productDesc;
        $product->image = $req->file('productImage')->store('public');
        $product->price = $req->productPrice;
        $product->toggle_rating = ($req->productRating == null) ? 0 : 1;
        $product->save();
        return redirect('dashboard/products')->with('message', 'Nieuw product is succesvol aangemaakt!');
    }

    function read(){
        $products = Product::all();
        return view('dashboard/products',['products'=>$products]);
    }

    function delete(Request $req){
        $product=Product::find($req->productId);
        $product->delete();
        Storage::delete($req->productImage);
        return redirect('dashboard/products')->with('message', 'Product is succesvol verwijderd!');
    }
}
