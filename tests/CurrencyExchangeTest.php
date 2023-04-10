<?php
/**
 * Date 10/04/2023
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Ssiva\CurrencyExchange\Tests;

use Orchestra\Testbench\TestCase;
use Ssiva\CurrencyExchange\CurrencyExchangeServiceProvider;

use Ssiva\CurrencyExchange\Exchange\Contracts\Config;

class CurrencyExchangeTest extends TestCase
{
    public function testConvert()
    {
        $response = $this->get(route("currency-exchange" , [ "amount" => 100, "currency" => "USD"]));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'amount','currency',
        ]);
    
    }
    
    public function testDefaultConfig(): void
    {
        $configValue = config('currency-exchange.default_currency');
        $this->assertEquals('EUR', $configValue);
    }

    public function testCustomConfig(): void
    {
        config(['currency-exchange.default_currency' => 'USD']);
        $configValue = config('currency-exchange.default_currency');
        $this->assertEquals('USD', $configValue);
    }

    protected function getPackageProviders($app): array
    {
        return [
            CurrencyExchangeServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.debug', true);
    }

}
