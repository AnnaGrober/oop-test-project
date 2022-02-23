<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use App\Models\User;

class UserService
{

    public function getUser()
    {
        return User::with('roles')->findOrFail(auth()->id());
    }
}
