<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Invite;
use Illuminate\Support\Facades\DB;

class OrganizerService
{
    /**
     * @param int $id
     *
     * @return Invite
     */
    public function userInvite(int $id) :Invite
    {
        $invite =  new Invite(['user_id' => $id]);
        $invite->save();
        return $invite;
    }

}
