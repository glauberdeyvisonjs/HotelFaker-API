<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function logado() {
        return view('app.home');
    }

    public function logout() {
        session_destroy();
        return redirect()->route('site.principal');
    }
}
