<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RecuperarController extends Controller
{
    public function view(Request $request)
    {

        return view('site.recuperar');
    }

    public function recuperar(Request $request)
    {
        $regras = [
            'email' => 'email'
        ];

        $regrasFeedback = [
            'email.email' => 'O campo e-mail deve ser preenchido.'
        ];

        $request->validate($regras, $regrasFeedback);

        $email = $request->get('email');

        $user = new User();
        $existe = $user->where('email', $email)
            ->first();

        if (isset($existe->email)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['email'] = $existe->email;

            return redirect()->route('site.recuperar')->with('info', 'Um e-mail de redefinição foi enviado');
        } else {
            return redirect()->route('site.recuperar')->with('error', 'O usuário não consta em nosso banco de dados');
        }
    }
}
