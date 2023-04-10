<?php
/**
 * Date 10/04/2023
 *
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Ssiva\CurrencyExchange\Exchange;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Exchange
{
    /**
     * @var Client
     */
    protected Client $client;
    /**
     * @var mixed|null
     */
    protected mixed $config;

    public function __construct($config = null)
    {
        $this->client = new Client();
        $this->config = $config;
    }

    /**
     * @throws GuzzleException
     */
    public function getExchangeRate($currency): mixed
    {
        $source = config('currency-exchange.exchange_rate_url');
        $currency = $currency ?: config('currency-exchange.default_currency');
        $response = $this->client->get($source);

        $xml = $response->getBody()->getContents();
        $data = json_decode(json_encode(simplexml_load_string($xml)), true);
        $rates = $data['Cube']['Cube']['Cube'];
        $exchangeRate = null;
        foreach ($rates as $rate) {
            if ($rate['@attributes']['currency'] == $currency) {
                $exchangeRate = $rate['@attributes']['rate'];
                break;
            }
        }
        return $exchangeRate;
    }

}
