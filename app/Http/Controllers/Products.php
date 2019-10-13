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
    function update(Request $req){
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
        return redirect('dashboard/products')->with('message', 'product is succesvol bijgewerkt!');

    }
    function find(Request $req){
        $product=Product::find($req->productId);
        return view('dashboard/edit-product',['product'=>$product]);
    }

}
