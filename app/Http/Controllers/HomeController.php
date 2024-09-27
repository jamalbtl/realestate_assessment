<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class HomeController extends Controller
{
    function index(){
      $properties=Property::with('images')->get();
    //   dd($properties);
      return view('frontend.index',compact('properties'));  
    }
}
