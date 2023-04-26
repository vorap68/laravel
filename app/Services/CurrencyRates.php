<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class CurrencyRates
{
    public static function getRates()
    {
        $baseCurrency = CurrencyConversion::getBaseCurrency();

        $url = config('currency_rates.api_url');

        $client = new Client();

        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('There is a problem with currency rate service');
        }

        $rates = json_decode($response->getBody()->getContents(), true);

        //dd($rates);
        foreach (CurrencyConversion::getCurrencies() as $currency) {
            if (!$currency->isMain()) {
              
                    //dd($currency->code);
                    foreach ($rates as $key => $value) {
                        if($value['ccy'] == $currency->code){
                            $currency->update(['rate' => $value['buy']]);
                    }
//                    $currency->touch();
                    }
            }
        }
    }
}
