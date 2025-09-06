<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Se la sessione contiene 'user', consideriamo autenticato (demo JSON)
        if (session('user')) {
            // Non fare nulla, lascia passare
            return null;
        }
        // Se NON autenticato, reindirizza a login
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    public function handle($request, \Closure $next, ...$guards)
    {
        // Demo JSON: se c'è session('user'), lascia passare
        if (session('user')) {
            return $next($request);
        }
        return parent::handle($request, $next, ...$guards);
    }
}
