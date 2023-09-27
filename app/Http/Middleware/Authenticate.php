<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (collect($request->route()->middleware())->contains('auth:api')) {
            throw new HttpResponseException(response()->json([
                'data' => null,
                'message' => 'Unauthenticated',
                'status_code' => Response::HTTP_UNAUTHORIZED
            ], Response::HTTP_UNAUTHORIZED));
        }

        return $request->expectsJson() ? null : route('login');
    }
}
