<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AdminService
{

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return User::with('roles')->get();
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function userCreate(array $data): User
    {
        $user = new User($data);
        $user->save();
        if ($data['organizer']) {
            DB::transaction(function ($e) use ($user) {
                $user->roles()->attach([config('params.organizer_id')]);
                $event = new Event(['organizer_id' => $user->id]);
                $event->save();
            });
        }

        return $user;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function userDelete(int $id)
    {
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            abort(403, 'Access denied');
        } else {
            return User::find($id)->delete();
        }
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function userBlock(int $id): User
    {
        $user = User::find($id);
        if ($user->hasRole('admin') || $user->hasRole('organizer')) {
            abort(403, 'Access denied');
        } else {
            $user         = User::find($id);
            $user->active = 0;
            $user->save();
        }

        return $user;
    }

}
