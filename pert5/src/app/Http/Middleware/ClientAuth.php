<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $client = Client::where('api_token', $token)->first();
        if(!$client) {
            return response()->json([
                'message' => 'Unathorized'
            ], 401);
        }
        $request->merge(['authenticated_client' => $client]);
        return $next($request);
    }
}
