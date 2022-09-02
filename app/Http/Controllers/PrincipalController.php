<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;

class PrincipalController extends Controller
{
    public function principal(){

        return view('site.principal');
    }

    public function login(Request $request){
        
    }
}