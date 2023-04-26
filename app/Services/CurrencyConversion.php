<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion
{
    const DEFAULT_CURRENCY_CODE = 'UAH';

    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        self::loadContainer();

        return self::$container;
    }

    public static function getCurrencyFromSession()
    {
        return session('currency', self::DEFAULT_CURRENCY_CODE);
    }

    public static function getCurrentCurrencyFromSession()
    {
        self::loadContainer();
        $currencyCode = self::getCurrencyFromSession();

        foreach (self::$container as $currency) {
            if ($currency->code === $currencyCode) {
              // dd($currency);
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

//        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {
//            if ($originCurrency->rate != 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
//                CurrencyRates::getRates();
//                self::loadContainer();
//                $originCurrency = self::$container[$originCurrencyCode];
//            }
//        }
//
        if (is_null($targetCurrencyCode)) {
           // $targetCurrencyCode = self::getCurrencyFromSession();
             $targetCurrencyCode  = session('currency','UAH');
        }

        $targetCurrency = self::$container[$targetCurrencyCode];
//        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {
//            if ($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
//                CurrencyRates::getRates();
//                self::loadContainer();
//                $targetCurrency = self::$container[$targetCurrencyCode];
//            }
//        }
//        $originCurrency    = Currency::byCode($originCurrencyCode)->first();
//        if(is_null($targetCurrencyCode)){
//            $targetCurrencyCode = session('currency','UAH');
//        }
//        $targetCurrency    = Currency::byCode($targetCurrencyCode)->first();
        //dd($originCurrency->rate);
        return round($sum /$targetCurrency->rate,2);
    }

    
    //App\Services\CurrencyConversion::getCurrencySymbol()
    public static function getCurrencySymbol()
    {
        self::loadContainer();

        $currencyFromSession = self::getCurrencyFromSession();

        $currency = self::$container[$currencyFromSession];
        return $currency->symbol;
       // return session('currency','UAH');
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (self::$container as $code => $currency) {
            if ($currency->isMain()) {
                return $currency;
            }
        }
    }
}
