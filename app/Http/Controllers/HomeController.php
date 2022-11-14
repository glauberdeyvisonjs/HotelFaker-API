<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login()
    {
        $existe = User::where('email', $request->email)->whereNull('deleted_at')->first();

        //  Se o parâmetro de e-mail vindo do request existir no banco de dados...
        if (isset($existe->email) && Hash::check($request->password, $existe->password)) {

            //  ... atribua o id e e-mail para a session...
            session()->put('id', $existe->id);

            //  ... e redirecione para a rota home.
            return response('Logado!', 200);

            //  Se o e-mail informado não existir, redirecione de volta informando um erro.
        } else {
            return response('Usuário ou password inválidos', 400);
        }
    }

    public function logout()
    {
        session()->forget('id');
        return response('Logout efetuado com sucesso!', 200);
    }
}
