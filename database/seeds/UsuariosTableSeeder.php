<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nome' => 'Vox Digital',
            'usuario' => 'vox',
            'email' => 'davi@voxdigital.com.br',
            'senha' => Hash::make('vox@2018'),
            'remember_token' => str_random(60)
        ]);
    }
}
