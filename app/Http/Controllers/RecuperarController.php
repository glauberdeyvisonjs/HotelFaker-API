<?php

namespace App\Http\Controllers;

use App\Models\UserHelper;
use Illuminate\Http\Request;

class RecuperarController extends Controller
{
    public function view(Request $request){

        $feedback = '';

        if ($request->get('feedback') == 1) {
            $feedback = 'Um e-mail de recuperação foi enviado.';
        }

        if ($request->get('feedback') == 2) {
            $feedback = 'O e-mail não consta em nosso banco de dados.';
        }

        return view('site.recuperar', ['feedback' => $feedback]);
    }

    public function recuperar(Request $request) {
        $regras = [
            'email' => 'email'
        ];

        $regrasFeedback = [
            'email.email' => 'O campo e-mail deve ser preenchido.'
        ];

        $request->validate($regras, $regrasFeedback);

        $email = $request->get('email');

        $user = new UserHelper();
        $existe = $user->where('email', $email)
                    ->first();

        if (isset($existe->email)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['email'] = $existe->email;

            return redirect()->route('site.recuperar', ['feedback' => '1']);

        } else {
            return redirect()->route('site.recuperar', ['feedback' => '2']);
        }
        
    }
}
