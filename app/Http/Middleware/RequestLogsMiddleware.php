<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->user()->requestLogs()->create([
            'token_id' => $request->user()->accessTokens()->first()->id,
            'request_method' => $request->method(),
            'request_params' => json_encode($request->all())
        ]);

        $request->user()->increment('requests_count', 1);

        return $next($request);
    }
}
