<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{

    /**
     * @return mixed
     */
    public function getUser(): User
    {
        return User::with('roles')->findOrFail(Auth::id());
    }
}
