<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use App\Categories;

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
        return redirect('dashboard/categories');
    }
}
