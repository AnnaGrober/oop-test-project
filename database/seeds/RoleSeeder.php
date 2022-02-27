<?php

use Illuminate\Database\Seeder;

use \App\Models\Role;
use \Illuminate\Support\Arr;

class RoleSeeder extends Seeder
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
                'id'    => 1,
                'name'  => 'admin',
                'title' => 'Администратор',
            ],
            [
                'id'    => 2,
                'name'  => 'organizer',
                'title' => 'Организатор',
            ],
            [
                'id'    => 3,
                'name'  => 'user',
                'title' => 'Пользователь',
            ],
        ];
        foreach ($data as $value) {
            if (!Role::find($roleId = Arr::get($value, 'id'))) {
                $role        = new Role();
                $role->id    = $roleId;
                $role->name  = Arr::get($value, 'name');
                $role->title = Arr::get($value, 'title');
                $role->save();
            }
        }
    }

}
