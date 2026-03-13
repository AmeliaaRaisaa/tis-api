<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateBookYear
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $year = $request->year;

        if ($year) {

            if ($year < 1900 || $year > date('Y')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid book year'
                ], 400);
            }

        }

        return $next($request);
    }
}