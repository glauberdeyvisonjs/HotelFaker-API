<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Exception;
use Illuminate\Support\Facades\Hash;

class PrincipalController extends Controller
{
    public function principal(Request $request)
    {
        if (!is_null(session()->get('id'))) {
            return redirect()->route('app.home');
        } else {
            return view('site.principal');
        }
    }

    public function login(Request $request)
    {
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

        //  Recupera o ID, e-mail e senha vindos do request
        $email = $request->get('email');
        $senha = $request->get('senha');

        //  Cria um novo UserHelper com os parâmetros de e-mail e senha
        $user = new UserHelper();

        //  Atribui os parâmetros da variável $user na variável $existe apenas se for igual aos do banco de dados
        //  Caso não sejam iguais, $existe ficará null
        $existe = $user
            ->where('email', $email)
            ->whereNull('deleted_at')
            ->first();

        //  Se o parâmetro de e-mail vindo do request existir no banco de dados...
        if (isset($existe->email) && Hash::check($request->senha, $existe->senha)) {

            //  ... atribua o id e e-mail para a session...
            session()->put('id', $existe->id);
            session()->put('email', $existe->email);

            //  ... e redirecione para a rota home.
            return redirect()->route('app.home');

            //  Se o e-mail informado não existir, redirecione de volta informando um erro.
        } else {
            return redirect()->route('site.principal')->with('error', 'Usuário ou senha inválidos');
        }
    }

    public function logout()
    {
        session()->forget(['id', 'email']);
        return redirect()->route('site.principal');
    }
}
