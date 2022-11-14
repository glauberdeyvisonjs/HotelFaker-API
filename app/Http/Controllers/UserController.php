<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $list = User::whereNull('deleted_at')->get();
        return response()->json($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $searchUser = DB::table('users')->where('email', $request->email)->first();
        //  Puxa da tabela a informação de e-mail e compara com a informação vinda do request
        //  Caso tenha uma combinação igual, preencherá a variável, caso não tenha, a variável fica nula
        try {
            //  Caso a variável seja nula, o e-mail nunca foi cadastrado, logo a requisição de cadastro será completada
            if (is_null($searchUser)) {
                $user = User::create([
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => Hash::make($request->password)
                ]);

                $this->sendMail($user);

                return response()->json($user);

                //  Caso a variável venha preenchida, é porque o e-mail já foi cadastrado antes
                //  Deve-se verificar se a coluna "deleted_at" foi preenchida
            } else {

                // $searchUser = (object) $searchUser;

                //  Se a coluna "deleted_at" for nula, então o e-mail possui cadastro ativo, então dará erro
                if (is_null($searchUser->deleted_at)) {
                    return response('O e-mail informado já possui cadastro!', 409);

                    //  Se a coluna estiver preenchida, a conta já foi cadastrada e excluída, então o novo cadastro é permitido
                    //  É feito um update nas colunas de nome, password e deleted_at (null)
                } else {
                    $user = User::query()->where('id', $searchUser->id)->update([
                        'name' => $request->name,
                        'password' => Hash::make($request->password),
                        'deleted_at' => null
                    ]);
                    $user = User::query()->where('id', $searchUser->id)->first();

                    $this->sendMail($user);
                    //  Após
                    return response($user, 200);
                }
            }
        } catch (Exception $e) {
            return response($e, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

        if (is_null($user)) {
            return response('O usuário não existe!', 400);
        } else {
            if (!is_null($user->deleted_at)) {
                return response('O usuário já foi deletado!', 200);
            } else {
                return response()->json($user);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //  Tenta deletar o usuário com base no parâmetro recuperado do ID
            $user = User::query()->where('id', $id)->update([
                'deleted_at' => Carbon::now(),
            ]);
            session()->forget('id');

            return response('Usuário deletado com sucesso', 200);
        } catch (Exception $e) {
            //  Retorna um erro
            return response($e, 400);
        }
    }

    public function sendMail($user)
    {
        try {
            Mail::send('mail.emailVerification', ['linkValidation' => 'www.teste.com', 'user' => $user], function ($message) use ($user) {
                try {
                    $message->bcc($user->email, $user->nome)
                        ->subject('Seja bem vindo ao Fake Luxury Hostel, ' . $user->nome . '!');
                } catch (\Exception $e) {
                    return (object) [
                        'status_code' => 500,
                        'error' => (string) $e,
                    ];
                }
            });
            return response('E-mail enviado com sucesso', 200);
        } catch (\Exception $e) {
            response($e, 400);
        }
    }
}
