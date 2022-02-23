<?php

namespace App\Http\Controllers\Cabinet;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function getUser()
    {
        return Response()->json($this->service->getUser());
    }
}
