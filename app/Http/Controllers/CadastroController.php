<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;

class CadastroController extends Controller
{
    public function cadastro(Request $request){

        $erro = '';
        $e = 0;

        if ($request->get('erro') == 1) {
            $erro = "Erro ao cadastrar: $e";
        }

        return view('site.cadastro', ['erro' => $erro]);
    }

    public function cadastrar(Request $request) {


            $request->validate([
                'nome'=>'required|min:3|max:50',
                'email'=>'email',
                'senha'=>'required|min:6',
                'confirm_senha'=>'required'
            ]);
    
            try {
                $user = new UserHelper();
                $user->create($request->all());
                return redirect('/');
                
            } catch (Exception $e) {
                return redirect()->route('site.cadastro', ['erro' => '1']);
                
            }
    }
}
