<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // 🚫 Não redirecionar — apenas retornar 401 JSON
        if (! $request->expectsJson()) {
            abort(response()->json(['error' => 'Unauthorized'], 401));
        }

        return null;
    }
}
