<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {

  // Check if the user is authenticated
  if (!auth()->check()) {
    // If the user is not authenticated, redirect them to the login page
    return redirect()->route('login');
}

// Get the user's role from the authenticated user
$userRole = auth()->user()->role;

// Check if the user has one of the required roles
if (in_array($userRole, ['customer', 'author'])) {
    // If the user has one of the required roles, allow access to the route
    return $next($request);
}

// If the user does not have one of the required roles, return a 403 Forbidden response
return response('Unauthorized. You do not have permission to access this resource.', 403);
}
}
