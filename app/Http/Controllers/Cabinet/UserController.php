<?php

namespace App\Http\Controllers\Cabinet;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    private $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(): JsonResponse
    {
        return Response()->json($this->service->getUser());
    }
}
