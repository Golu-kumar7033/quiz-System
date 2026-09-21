<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next , string $role): Response
    {
        if (!auth()->check()) {
        return redirect()->route('login');
    }

        // Agar multiple roles check karne hain to comma se
        $roles = explode(',', $role);
    
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Aapko is page ka access nahi hai✋🏼');
        }

        return $next($request);
    }
}
