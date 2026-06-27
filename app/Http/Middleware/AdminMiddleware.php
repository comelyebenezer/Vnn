<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $allowedRoles = ['Super Admin', 'CEO', 'Managing Director', 'Editor In Chief', 'Managing Editor', 'Publisher', 'Journalist', 'Reporter', 'Fact Checker', 'Advertiser'];

        if (!auth()->user()->hasAnyRole($allowedRoles)) {
            abort(403, 'Unauthorized access to admin panel.');
        }

        return $next($request);
    }
}
