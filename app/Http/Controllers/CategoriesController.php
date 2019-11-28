<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use App\Categories;
use Auth;

class CategoriesController extends Controller
{
    function save(Request $req){
        $categories = new Categories;
        $category = new Category;
        $category->name = $req->categoryName;
        $category->save();

        $restaurant=Restaurant::where('user_id', $req->userId)->first();
        $categories->restaurant_id = Restaurant::where('name',$restaurant->name)->first()->id;
        $categories->category_id = $category->id;
        $categories->save();
        return redirect('dashboard/categories');
    }

    function read(){
        $userId = \Auth::user()->id;
        $restaurantId= Restaurant::where('user_id',$userId)->first()->id;
        $categories = Categories::where('restaurant_id',$restaurantId)->get();
        foreach($categories as $category){
            $category['categoryName'] = Category::find($category['category_id'])->name;
        }
        return view('dashboard/categories', $categories);
    }
}
