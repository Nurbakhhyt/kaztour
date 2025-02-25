<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUsers(){
        return view('admin.users');
    }

    public function showTours(){

    }

    public function showCities(){

    }

    public function showLocations(){

    }
}
