<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response | Request
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(["Message" => "Not Authentucated"], 401);
        } elseif ($user->type == 'user') {
            return response()->json(["Message" => "You dont have Access!"], 401);
        } else { //If user Is Admin (do the action)
            return $next($request);
        }

    }
}
