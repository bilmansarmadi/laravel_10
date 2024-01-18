<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $authenticate = false;
        $user = null;
        $token_id = true;
        if ($token) {
            $user = User::where('users_token', $token)->first();
            if ($user) {
                $authenticate = true;
                Auth::login($user);
            }else{
                $token_id = false;
            }
        }


        if ($token_id == false ) {
            $message = 'invalid token';
        }else{
            $message = 'unauthorized';
        }

        if ($authenticate) {
            return $next($request);
        } else {
            return response()->json([
                "code" => 401,
                "success" => false,
                "data" => null,
                "error" => [
                    "message" => [$message]
                ]
            ])->setStatusCode(401);
        }
    }

}
