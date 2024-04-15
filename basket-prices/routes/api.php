<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/price', function (Request $request) {
    $discounts = $request->attributes->get('discounts');
    $productItems = $request->input('productItems');
    $totalAmount = 0;

    if (!$productItems) {
        return $totalAmount;
    }

    foreach ($productItems as $productItem) {
        $productAmount = $productItem['items'] * $productItem['unitPrice'];

        foreach ($discounts['itemsDiscounts'] as $itemDiscount) {
            if ($itemDiscount['product'] === $productItem['productName']) {
                $discountAmount = $productAmount * $itemDiscount['discount'] / 100;
                $productAmount = $productAmount - $discountAmount;
            }
        }

        $totalAmount += $productAmount;
    }

    $totalDiscountAmount = 0;
    if ($discounts['totalDiscount']) {
        $totalDiscountAmount = $totalAmount * $discounts['totalDiscount'] / 100;
    }
    
    $totalParsedAmount = ($totalAmount - $totalDiscountAmount) / 100; // cent to eur

    return "Your total purchase prices is: ". round($totalParsedAmount, 2) ." €"; 
})
    ->middleware([
        'initDiscounts',
        'ruleAgeDiscount:21,15',
        'ruleItemsRepeatedDiscount:3,5',
        'ruleTotalAmountDiscount:100,20'
    ]);
