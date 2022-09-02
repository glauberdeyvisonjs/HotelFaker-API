<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperarController extends Controller
{
    public function recuperar(){
        return view('site.recuperar');
    }
}
