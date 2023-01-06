<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        // dd('caiu aqui');
        $existe = User::where('email', $request->email)->whereNull('deleted_at')->first();
        // dd($existe);

        //  Se o parâmetro de e-mail vindo do request existir no banco de dados...
        if (isset($existe->email) && Hash::check($request->password, $existe->password)) {

            //  ... atribua o id e e-mail para a session...
            session(['id' => $existe->id, 'email' => $existe->email]);
            return response()->json($existe);

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
