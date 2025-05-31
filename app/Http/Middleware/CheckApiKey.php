<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('x-api-key');//to define custom header, standard definition of custom header start from x

        if ($key !== config('app.api_key')) {
            return Response::json([
                'message' => 'Invalid API key',
            ], 400);
        }
        $user = Auth::guard('sanctum')->user();
//        $user = $request->user();
//        dd($user,$user2);
        //$user = $request->user();
        if ($user) {
//            dd($user->currentAccessToken());
            $user->currentAccessToken()->forceFill([
                'ip_address' => $request->ip()
            ])->save();
        }

        return $next($request);
    }
}
