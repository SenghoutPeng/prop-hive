<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // In API, don't redirect, just return 401
        if (!$request->expectsJson()) {
            return null;
        }

        return null;
    }
}
