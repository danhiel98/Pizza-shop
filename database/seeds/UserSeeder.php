<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate(); // Eliminar los registros de la tabla

        // Definir los usuarios a insertar
        $users = [
            [
                'name'     => 'Principal',
                'email'    => 'admin@mail.com',
                'password' => bcrypt('admin'),
                'type'     => User::NORMAL_USER
            ],
            [
                'name'     => 'Andrea Orellana',
                'email'    => 'andrea@mail.com',
                'password' => bcrypt('secret'),
                'type'     => User::CLIENT_USER
            ],
            [
                'name'     => 'Jimmy Rosales',
                'email'    => 'jimmy@mail.com',
                'password' => bcrypt('secret'),
                'type'     => User::CLIENT_USER
            ],
        ];

        // Insertar usuarios en la tabla
        foreach ($users as $user) User::create($user);
    }
}
