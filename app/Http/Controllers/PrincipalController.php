<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;

class PrincipalController extends Controller
{
    public function principal(Request $request){

        return view('site.principal');
    }

    public function login (Request $request){
        $regras = [
            'email' => 'email|exists:user_helpers,email',
            'senha' => 'required'
        ];

        $regrasFeedback = [
            'email.email' => 'Você deve preencher um endereço de e-mail válido.',
            'email.exists' => 'O e-mail informado não possui cadastro em nosso sistema.',
            'senha.required' => 'A senha não pode ficar em branco.'
        ];

        $request->validate($regras, $regrasFeedback);

        $id = $request->get('id');
        $email = $request->get('email');
        $senha = $request->get('senha');

        $user = new UserHelper();
        $existe = $user
                    ->where('email', $email)
                    ->where('senha', $senha)
                    ->first();

        if (isset($existe->email)){
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['id'] = $existe->id;
            $_SESSION['email'] = $existe->email;
            $_SESSION['senha'] = $existe->senha;

            // dd($_SESSION);

            return redirect()->route('app.home');

        } else {
            // dd($_SESSION);
            return redirect()->route('site.principal')->with('error', 'Usuário ou senha inválidos');
        }
        

    }

    public function logout() {
        session_destroy();
        return redirect()->route('site.principal');
    }
}