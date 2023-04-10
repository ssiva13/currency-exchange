<?php

/**
 * Date 10/04/2023
 * @author   Simon Siva <simonsiva13@gmail.com>
 */


use Ssiva\CurrencyExchange\Controllers\CurrencyConverterController;

Route::get('v1/currency-exchange', [CurrencyConverterController::class, 'exchange'])->name('currency-exchange');

