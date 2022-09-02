<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;

class CadastroController extends Controller
{
    public function cadastro(){

        return view('site.cadastro');
    }

    public function cadastrar(Request $request) {

        if($request->senha == $request->confirm_senha){

            $request->validate([
                'nome'=>'required|min:5|max:40',
                'email'=>'email',
                'senha'=>'required|min:6',
                'confirm-senha'=>'required'
            ]);
    
            try {
                UserHelper::create([
                    'nome'=>$request->nome,
                    'email'=>$request->email,
                    'senha'=>$request->senha
                ]);
                return redirect('/');
            } catch (Exception $e) {
                dd($e);
            } 

        } else {
            
        }
    }
}
