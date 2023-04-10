<?php
/**
 * Date 10/04/2023
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Tests;

use Ssiva\CurrencyExchange\CurrencyExchangeServiceProvider;

class CurrencyExchangeTest extends \Orchestra\Testbench\TestCase
{
    public function testConvert()
    {
        $response = $this->get('/api/v1/currency-exchange?amount=100&currency=USD');
        $response->assertStatus(200);
        $response->assertJson([
            'converted_amount' => 490.49,
            'currency' => 'RON',
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
