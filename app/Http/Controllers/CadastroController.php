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

        $feedback = '';
        $e = 0;

        if ($request->get('feedback') == 1) {
            $feedback = "Erro ao cadastrar: $e";
        }

        if ($request->get('feedback') == 2) {
            $feedback = "Usuário cadastrado com sucesso!";
        }

        if ($request->get('feedback') == 3) {
            $feedback = "Usuário já cadastrado no Sistema";
        }
        
        return view('site.cadastro', ['feedback' => $feedback]);
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
                // 'email.unique' => 'O e-mail já foi cadastrado.',
                'senha.required' => 'A senha não pode ficar em branco.',
                'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
                'confirm_senha.required' => 'A confirmação de senha não pode ficar em branco.',
                'confirm_senha.same' => 'As senhas não correspondem.'
            ];

            $request->validate($regras, $regrasFeedback);

                try {
                    $searchUser = DB::table('user_helpers')->where('email',$request->email)->first();
                    $searchUser = (object) $searchUser;

                    if(is_null($searchUser)){
                        $user = new UserHelper();
                        $user->create($request->all());
                        return redirect()->route('site.cadastro', ['feedback' => '2']);
                    } else {
                        if(is_null($searchUser->deleted_at)){
                            return redirect()->route('site.cadastro', ['feedback' => '3']);
                        }else{
                            $user = DB::table('user_helpers')->where('id',$searchUser->id)->whereNotNull('deleted_at')
                            ->update([
                                'deleted_at'=>null,
                                'nome'=>$request->nome,
                                'senha'=>$request->senha
                            ]);      
                            return redirect()->route('site.cadastro', ['feedback' => '2']);

                        }
                    }

                    
                } catch (Exception $e) {
                    dd($e);
                    return redirect()->route('site.cadastro', ['feedback' => '1']);
                    
                }
            
    }

    public function delete (UserHelper $usuario) {

        $id = $_SESSION['id'];


        try {

            UserHelper::query()->where('id', $id)->firstorfail()->delete();

            return redirect()->route('site.principal', ['feedback' => '3']);

        } catch (Exception $e) {
            dd($e);
            return redirect()->route('site.principal', ['feedback' => '4']);
        }
    }
}
