<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * @param         $request
     * @param Closure $next
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        foreach($roles as $role) {
            $user = Auth::user();
            if($user->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect('login');
    }
}
