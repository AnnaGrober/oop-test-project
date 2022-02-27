<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\OnlyUserIdRequest;
use App\Services\Admin\AdminService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{

    private $service;

    /**
     * @param AdminService $service
     */
    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers()
    {
        $admin = Auth::user();

        return view('admin/admin', [
            'users'     => $this->service->getUsers(),
            'admin'     => $admin->hasRole('admin'),
            'organizer' => $admin->hasRole('organizer'),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateUserForm()
    {
        return view('admin/user-create');
    }

    /**
     * @param UserCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    final public function userCreate(UserCreateRequest $request): JsonResponse
    {
        return Response()->json($this->service->userCreate($request->input()));
    }

    /**
     * @param OnlyUserIdRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    final public function userDelete(OnlyUserIdRequest $request): JsonResponse
    {
        return Response()->json($this->service->userDelete($request->input('id')));
    }

    /**
     * @param OnlyUserIdRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userBlock(OnlyUserIdRequest $request): JsonResponse
    {
        return Response()->json($this->service->userBlock($request->input('id')));
    }
}
