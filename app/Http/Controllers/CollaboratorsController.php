<?php

namespace App\Http\Controllers;

use App\Models\Collaborators;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CollaboratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $list = Collaborators::whereNull('deleted_at')->get();
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
        $increment = DB::table('collaborators')->orderBy('id', 'DESC')->first('registration');
        if (!is_null($increment)) {
            $increment = strval($increment->registration + 1);
            $count = strlen($increment);

            $sub = 8 - $count;

            for ($i = 0; $i < $sub; $i++) {
                $increment = '0' . strval($increment);
            }
        } else {
            $increment = '00000001';
        }

        try {
            $collaborator = Collaborators::create([
                'name' => $request->name,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'registration' => $increment,
                'password' => Hash::make($request->password),
                'flag_permissions' => isset($request->flag_permissions) ? $request->flag_permissions : '0',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!is_null($user)) {
                User::where('id', $user->id)->update([
                    'flag_collaborator' => '1'
                ]);
            }

            return response()->json($collaborator);
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
        $collaborator = Collaborators::where('id', $id)->first();
        if (is_null($collaborator)) {
            return response('O usuário não existe!', 400);
        } else {
            if (!is_null($collaborator->deleted_at)) {
                return response('O usuário já foi deletado!', 200);
            } else {
                return response()->json($collaborator);
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
            Collaborators::query()->where('id', $id)->update([
                'deleted_at' => Carbon::now(),
            ]);
            return response('Usuário deletado com sucesso', 200);
            return response($e, 400);
        } catch (Exception $e) {
            //  Retorna um erro
            return response($e, 400);
        }
    }
}
