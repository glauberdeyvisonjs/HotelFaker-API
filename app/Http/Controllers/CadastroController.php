<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;

class CadastroController extends Controller
{
    public function cadastro(Request $request){

        return view('site.cadastro');
    }

    public function cadastrar(Request $request) {


            $request->validate([
                'nome'=>'required|min:5|max:40',
                'email'=>'email',
                'senha'=>'required|min:6'
            ]);
    
            try {
                $user = new UserHelper();
                $user->create($request->all());
                return redirect('/');
            } catch (Exception $e) {
                return redirect('/');
                dd($e);
            }
    }
}
