<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitDiscounts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $discounts = [
            'totalDiscount' => 0,
            'itemsDiscounts' => []
        ];

        $request->attributes->add(['discounts' => $discounts]);

        return $next($request);
    }
}
