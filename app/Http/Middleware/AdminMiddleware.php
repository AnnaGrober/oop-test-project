<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * @param         $request
     * @param Closure $next
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {   dd($roles);
        if (Auth::user() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            $user = Auth::user();

            if($user->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect('login');
    }
}
