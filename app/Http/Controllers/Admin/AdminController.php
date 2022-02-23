<?php

namespace App\Http\Controllers\Admin;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\Admin\AdminService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserDeleteRequest;
use App\Http\Requests\Admin\UserBlockRequest;

class AdminController extends Controller
{

    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function getUsers()
    {
        return view('admin/admin', ['users' => $this->service->getUsers()]);
    }

    public function getCreateUserForm()
    {
        return view('admin/user-create');
    }

    public function userCreate(UserCreateRequest $request){
        return Response()->json($this->service->userCreate($request->input()));
    }

    public function userDelete(UserDeleteRequest $request){
        return Response()->json($this->service->userDelete($request->input('id')));
    }

    public function userBlock(UserBlockRequest $request){
        return Response()->json($this->service->userBlock($request->input('id')));
    }
}
