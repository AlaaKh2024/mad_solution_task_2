<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckTokenExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $user = Auth::user();
    $token = $user->currentAccessToken();
    
    if ($token && now()->diffInMinutes($token->created_at) > 5) {
       
        $token->delete();
        
        return response()->json(['message' => 'Token expired'], 401);
    }

    return $next($request);
}
}