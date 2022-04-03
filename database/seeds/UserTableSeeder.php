<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id   = mt_rand(1, '123456789');
        $date = date('Y-m-d H:i:s');
    
        User::create([
            'id' => $id,
            'name' => 'Unionlux',
            'email' => 'unionlux@unionlux.com.br',
            'department' => 'Escritório',
            'whatsapp' => 1,
            'photo' => 'http://www.unionlux.com.br/assets/images/logo/logo.png',
            'phone' => '71983025891',
            'password' => 'UnionLux@2020',
            'active' => 1,
            'message_whatsapp' => 'Olá, visitei o site unionlux.com.br e gostaria de algumas informações...',
            'created_at' => $date
        ]);
    }
}
