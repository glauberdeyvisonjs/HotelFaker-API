<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CadastroController extends Controller
{
    public function cadastro(Request $request){

        return view('site.cadastro');
    }

    public function cadastrar(Request $request) {

            $regras = [
                'nome'=>'required|min:3|max:50',
                'email'=>'email',
                'senha'=>'required|min:6',
                'confirm_senha'=>'required|same:senha'
            ];

            $regrasFeedback = [
                'nome.required' => 'O nome não pode ficar em branco.',
                'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',
                'nome.max' => 'O nome deve ter no máximo 50 caracteres.',
                'email.email' => 'Você deve preencher um endereço de e-mail válido.',
                'senha.required' => 'A senha não pode ficar em branco.',
                'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
                'confirm_senha.required' => 'A confirmação de senha não pode ficar em branco.',
                'confirm_senha.same' => 'As senhas não correspondem.'
            ];

            $request->validate($regras, $regrasFeedback);

                try {
                    $searchUser = DB::table('user_helpers')->where('email',$request->email)->first();

                    if(is_null($searchUser)){
                        $user = new UserHelper();
                        $user->create($request->all());
                        return redirect()->route('site.principal')->with('success', 'Usuário cadastrado com sucesso!');
                    } else {
                        $searchUser = (object) $searchUser;

                        if(is_null($searchUser->deleted_at)){
                            return redirect()->route('site.cadastro', ['feedback' => '3']);
                        }else{
                            $user = DB::table('user_helpers')->where('id',$searchUser->id)->whereNotNull('deleted_at')
                            ->update([
                                'deleted_at'=>null,
                                'nome'=>$request->nome,
                                'senha'=>$request->senha
                            ]);      
                            return redirect()->route('site.principal')->with('success', 'Usuário cadastrado com sucesso!');

                        }
                    }

                    
                } catch (Exception $e) {
                    dd($e);
                    return redirect()->route('site.cadastro')->with('error', 'Erro ao cadastrar usuário');
                    
                }
            
    }

    public function delete (UserHelper $usuario) {

        $id = $_SESSION['id'];


        try {

            UserHelper::query()->where('id', $id)->firstorfail()->delete();

            return redirect()->route('site.principal')->with('warning', 'Usuário excluido com sucesso');

        } catch (Exception $e) {
            dd($e);
            return redirect()->route('site.principal')->with('error', 'Erro ao deletar usuário');
        }
    }
}
