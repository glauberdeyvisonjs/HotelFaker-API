<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserHelper;
use Illuminate\Support\Facades\DB;

class UserHelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new UserHelper();
        $user->nome = 'Lucas';
        $user->email = 'lucas@teste.com';
        $user->senha = '12345';
        $user->save();

        UserHelper::create([
            'nome' => 'Glauber',
            'email' => 'glauber@teste.com',
            'senha' => '12345'
        ]);
/*
        DB::table('user_helpers')->insert([
            'nome' => 'Bruno',
            'email' => 'bruno@teste.com',
            'senha' => '12345'
        ]);
*/
    }

}
