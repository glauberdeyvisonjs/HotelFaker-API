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

        if ($request->get('erro') == 2) {
            $erro = 'É necessário realizar login';
        }
        
        return view('site.principal', ['erro' => $erro]);
    }

    public function login (Request $request){
        $regras = [
            'email' => 'email',
            'senha' => 'required'
        ];

        $request->validate($regras);

        $email = $request->get('email');
        $senha = $request->get('senha');

        $user = new UserHelper();
        $existe = $user->where('email', $email)
                    ->where('senha', $senha)
                    ->first();

        if (isset($existe->email)){
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['email'] = $existe->email;
            $_SESSION['senha'] = $existe->senha;

            // dd($_SESSION);

            return redirect()->route('app.home');

        } else {
            // dd($_SESSION);
            return redirect()->route('site.principal', ['erro' => '1']);
        }
        

    }

    public function logout() {
        session_destroy();
        return redirect()->route('site.principal');
    }
}