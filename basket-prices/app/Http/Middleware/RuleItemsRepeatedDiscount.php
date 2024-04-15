<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RuleItemsRepeatedDiscount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $itemsRepeatedRule, String $discount): Response
    {
        $discounts = $request->attributes->get('discounts');
        $productItems = $request->input('productItems');

        if (!$productItems) {
            return $next($request);
        }

        foreach ($productItems as $productItem) {
            if ($productItem['items'] >= (int) $itemsRepeatedRule) {
                $productDiscount = array(
                    'product' => $productItem['productName'],
                    'discount' => 5,
                );
                array_push($discounts['itemsDiscounts'], $productDiscount);
            }
        }

        $request->attributes->add(['discounts' => $discounts]);

        return $next($request);
    }
}
