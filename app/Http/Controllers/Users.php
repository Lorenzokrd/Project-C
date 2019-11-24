<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facad;
use App\User;

class users extends Controller
{
    public function index(){
    $data= User:: all();
    return view('user1',['data'=>$data]);
    }
}
