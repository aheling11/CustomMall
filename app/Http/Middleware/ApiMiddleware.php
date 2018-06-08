<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        // Pre-Middleware Action
        if (($request->method() == 'POST') && $request->path() == 'api/user') {
            $response = $next($request);
            return $response;
        }

        $user = User::findByToken($request->input('token'));

        if (empty($user)) {
            return new Response([
                'code' => -1,
                'message' => 'No Login',
                'data' => null
            ]);
        }

        $request->offsetSet('user', $user);

        return $next($request);
    }

}
