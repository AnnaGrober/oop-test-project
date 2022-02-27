<?php

namespace App\Http\Controllers\Admin;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\Admin\OrganizerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OnlyUserIdRequest;
use \Illuminate\Http\JsonResponse;

class OrganizerController extends AdminController
{
    private $service;

    /**
     * @param OrganizerService $service
     */
    public function __construct(OrganizerService $service)
    {
        $this->service = $service;
    }

    /**
     * @param OnlyUserIdRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInvite(OnlyUserIdRequest $request): JsonResponse
    {
        return Response()->json($this->service->userInvite($request->input('id')));
    }

}
