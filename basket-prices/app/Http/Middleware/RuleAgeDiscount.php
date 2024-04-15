<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RuleAgeDiscount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $age, String $discount): Response
    {   
        $user = $request->input('user');
        $discounts = $request->attributes->get('discounts');

        if ($user['age'] < (int) $age) {
            $discounts['totalDiscount'] += (int) $discount;
        }

        $request->attributes->add(['discounts' => $discounts]);

        return $next($request);
    }
}
