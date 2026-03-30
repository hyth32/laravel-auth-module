<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenAbility
{
    public function handle(Request $request, Closure $next, string $ability): Response
    {
        $token = $request->user()?->currentAccessToken();

        if ($token === null) {
            abort(Response::HTTP_UNAUTHORIZED, 'A bearer token is required.');
        }

        if (!$token->can($ability)) {
            abort(Response::HTTP_FORBIDDEN, "The provided token must have the [{$ability}] ability.");
        }

        return $next($request);
    }
}
