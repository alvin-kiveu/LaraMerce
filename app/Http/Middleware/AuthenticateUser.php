<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AuthenticateUser
{
    public function handle($request, Closure $next)
    {
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
        if ($user === null) {
            return redirect('/laradmin/login')->with('error', 'You have to login first, to access the page');
        }
        return $next($request);
    }
}
