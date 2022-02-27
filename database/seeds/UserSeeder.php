<?php

use Illuminate\Database\Seeder;

use \App\Models\User;
use \Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'       => 1,
                'name'     => 'Администратор',
                'email'    => 'anna.grober@mail.ru',
                'role'     => 1,
                'password' => '12345678',
            ],
            [
                'id'       => 2,
                'name'     => 'Петров Иван',
                'email'    => 'a.grober@webregul.ru',
                'role'     => 2,
                'password' => '12345678',

            ],
            [
                'id'       => 3,
                'name'     => 'user',
                'title'    => 'Иванов Петр',
                'email'    => 'test@test.ru',
                'role'     => 3,
                'password' => '12345678',
            ],
        ];
        foreach ($data as $value) {
            if (!User::find($userId = Arr::get($value, 'id'))) {
                $user        = new User([
                    'id'    => $userId,
                    'name'  => Arr::get($value, 'name'),
                    'email' => Arr::get($value, 'email'),
                    'password' => \Illuminate\Support\Facades\Hash::make( Arr::get($value, 'password'))

                ]);
                $user->save();
                $user->roles()->attach(Arr::get($value, 'role'));
            }
        }
    }

}
