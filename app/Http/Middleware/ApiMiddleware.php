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

        if($request->method() == 'OPTIONS'){
            $response = $next($request);
            return $response;
        }

        // Pre-Middleware Action
        if (($request->method() == 'POST') && $request->path() == 'api/user') {
            $response = $next($request);
            return $response;
        }

        // Pre-Middleware Action
        if (($request->method() == 'POST') && $request->path() == 'api/user/register') {
            $response = $next($request);
            return $response;
        }

        if (!$request->hasHeader('token')) {
            return new Response([
                'code' => -1,
                'message' => 'No Login',
                'data' => null
            ]);
        }

        $user = User::findByToken($request->header('token'));

        if (empty($user)) {
            return new Response([
                'code' => -1,
                'message' => 'No Login',
                'data' => null
            ]);
        }

        $request->merge(['user' => $user]);

        return $next($request);
    }

}
