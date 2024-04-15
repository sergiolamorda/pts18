<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\InitDiscounts;
use App\Http\Middleware\RuleAgeDiscount;
use App\Http\Middleware\RuleItemsRepeatedDiscount;
use App\Http\Middleware\RuleTotalAmountDiscount;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'initDiscounts' => InitDiscounts::class,
            'ruleAgeDiscount' => RuleAgeDiscount::class,
            'ruleItemsRepeatedDiscount' => RuleItemsRepeatedDiscount::class,
            'ruleTotalAmountDiscount' => RuleTotalAmountDiscount::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
