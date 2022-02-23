<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\User;

class AdminService
{

    public function getUsers()
    {
        return User::with('roles')->get();
    }

    public function userCreate(array $data)
    {
        $user = new User($data);
        $user->save();
        if ($data['organizer']) {
            $user->roles()->attach([config('params.organizer_id')]);
        }

        return $user;
    }

    public function userDelete(int $id)
    {
        $user = User::find($id);
        if ($user->isAdmin()) {
            //добавить потом экзепшн
        } else {
            return User::find($id)->delete();
        }
    }

    public function userBlock()
    {
        $user = User::find($id);
        if ($user->isAdmin()) {
            //добавить потом экзепшн
        } else {
            $user         = User::find($id);
            $user->status = 0;
            $user->save();
        }
    }
}
