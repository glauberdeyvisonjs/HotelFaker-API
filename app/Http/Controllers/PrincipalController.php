<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;

class PrincipalController extends Controller
{
    public function principal(Request $request){

        $erro = '';
        if ($request->get('erro') == 1) {
            $erro = 'Usuário ou senha inválidos';
        }
        
        return view('site.principal', ['erro' => $erro]);
    }

    public function login(Request $request){
        $regras = [
            'email' => 'email',
            'senha' => 'required'
        ];

        $request->validate($regras);

        $email = $request->get('email');
        $senha = $request->get('senha');

        $user = new UserHelper();
        $existe = $user->where('email', $email)->where('senha', $senha)->get()->first();

        if (isset($existe->email)) {
            dd($user);
        } else {
            return redirect()->route('site.principal', ['erro' => 1]);
        }
        

    }
}