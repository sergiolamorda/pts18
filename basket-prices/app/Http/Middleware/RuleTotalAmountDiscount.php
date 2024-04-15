<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RuleTotalAmountDiscount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $totalAmount, String $discount): Response
    {
        $discounts = $request->attributes->get('discounts');
        $productItems = $request->input('productItems');

        if (!$productItems) {
            return $next($request);
        }

        $totalAmountBeforeDiscounts = 0;
        foreach ($productItems as $productItem) {
            $totalAmountBeforeDiscounts += $productItem['items'] * $productItem['unitPrice'];
        }

        if ($totalAmountBeforeDiscounts > $totalAmount * 100) {
            $discounts['totalDiscount'] += (int) $discount;
        }

        $request->attributes->add(['discounts' => $discounts]);

        return $next($request);
    }
}
