<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facad;
use Illuminate\Support\Facades\Storage;

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
}
