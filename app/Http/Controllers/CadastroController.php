<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CadastroController extends Controller
{
    public function cadastro(Request $request)
    {
        return view('site.cadastro');
    }

    public function cadastrar(Request $request)
    {

        $regras = [
            'nome' => 'required|min:3|max:50',
            'email' => 'email',
            'senha' => 'required|min:6',
            'confirm_senha' => 'required|same:senha'
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
            //  Puxa da tabela a informação de e-mail e compara com a informação vinda do request
            //  Caso tenha uma combinação igual, preencherá a variável, caso não tenha, a variável fica nula
            $searchUser = DB::table('user_helpers')->where('email', $request->email)->first();

            //  Caso a variável seja nula, o e-mail nunca foi cadastrado, logo a requisição de cadastro será completada
            if (is_null($searchUser)) {
                $user = new UserHelper();
                $user->create($request->all());
                $this->sendMail();
                return redirect()->route('site.principal')->with('success', 'Usuário cadastrado com sucesso!');

                //  Caso a variável venha preenchida, é porque o e-mail já foi cadastrado antes
                //  Deve-se verificar se a coluna "deleted_at" foi preenchida
            } else {

                $searchUser = (object) $searchUser;

                //  Se a coluna "deleted_at" for nula, então o e-mail possui cadastro ativo, então dará erro
                if (is_null($searchUser->deleted_at)) {
                    return redirect()->route('site.cadastro')->with('error', 'O e-mail informado já possui cadastro');

                    //  Se a coluna estiver preenchida, a conta já foi cadastrada e excluída, então o novo cadastro é permitido
                    //  É feito um update nas colunas de nome, senha e deleted_at (null)
                } else {
                    $user = DB::table('user_helpers')->where('id', $searchUser->id)->whereNotNull('deleted_at')
                        ->update([
                            'deleted_at' => null,
                            'nome' => $request->nome,
                            'senha' => $request->senha
                        ]);
                    $this->sendMail();
                    //  Após
                    return redirect()->route('site.principal')->with('success', 'Usuário cadastrado com sucesso!');
                }
            }
        } catch (Exception $e) {

            return redirect()->route('site.cadastro')->with('error', 'Erro ao cadastrar usuário');
        }
    }

    public function delete()
    {
        try {

            //  Tenta deletar o usuário com base no parâmetro recuperado do ID
            UserHelper::query()->where('id', session('id'))->firstorfail()->delete();

            return redirect()->route('site.principal')->with('warning', 'Usuário excluido com sucesso');
        } catch (Exception $e) {
            //  Retorna para a tela principal com um erro
            return redirect()->route('site.principal')->with('error', 'Erro ao deletar usuário');
        }
    }

    public function sendMail()
    {
        try {
            Mail::send('mail.emailVerification',['linkValidation', 'www.teste.com'], function ($message) {
                try {
                    $message->bcc('glauber.deyvisonjs@gmail.com', 'Glauber Deyvison')
                        ->subject('Seja bem vindo ao Fake Hostel!');
                } catch (\Exception $e) {
                    return (object) [
                        'status_code' => 500,
                        'error' => (string) $e,
                    ];
                }
            });
            return redirect()->route('site.principal')->with('success', 'E-mail enviado com sucesso');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
