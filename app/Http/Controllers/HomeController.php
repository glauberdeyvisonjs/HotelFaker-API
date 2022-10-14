<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function logado()
    {

        return view('app.home');
    }

    public function services()
    {
        return view('app.services');
    }

}
