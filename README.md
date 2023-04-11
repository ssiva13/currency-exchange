## Currency Exchange Package

This package provides a simple API for currency exchange rates using the European Central Bank daily reference rates.
The package must fetch the exchange rate of the day from the [European Central Bank](https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml) daily reference.

### Installation

You can install the package via composer from you project root in two ways:

- Local Dependency
  - Create Composer Local Dependency Source
    ```bash
        mkdir "libraries"
    ```
  - Clone repo
    ```bash
        git clone https://github.com/ssiva13/currency-exchange.git libraries/currency-exchange
    ```
  - Add Composer Local Dependency Source to the repositories key
    ```bash
    "repositories": {
        "local": {
            "type": "path",
            "url": "./libraries/*",
            "options": {
                "symlink": false
            }
        }
    },
    ```
    ```bash
      composer require ssiva/currency-exchange:dev-main
    ```
- Git Source
    - Add Composer Git or VCS Source to the repositories key
      ```bash
      "repositories": {
          "local": {
              "type": "git",
              "url": "https://github.com/ssiva13/currency-exchange.git",
              "options": {
                  "symlink": false
              }
          }
      },
      ```
      ```bash
        composer require ssiva/currency-exchange:dev-main
      ```

### Configuration

- Open your `config/app.php` and add the following to the `providers` array:

```php
// CurrencyExchange ServiceProvider
Ssiva\CurrencyExchange\CurrencyExchangeServiceProvider::class,
```

- Run the command below to publish the package config file `config/currency-exchange.php`

```bash
php artisan vendor:publish --provider="Ssiva\\CurrencyExchange\\CurrencyExchangeServiceProvider" --tag="currency-exchange"
````
This will create a currency-exchange.php file in your Laravel config directory where you can configure the package settings.

### Usage

To use the package, you can make a GET request to the following endpoint:

```php
GET /api/v1/exchange?amount=1004545&currency=ISK
```

Where amount is the amount of currency to exchange and currency is the currency to exchange to. If no currency is specified, the default currency (EUR) will be used.

The API will return the exchange rate for the given amount in the specified currency. The response will be in JSON format and will include the exchange rate and the converted amount.

```json
{
    "exchange_rate": 149.70,
    "amount": 150380386.5,
    "currency": "ISK"
}
```

### Testing

You can run the package tests using PHPUnit. The tests are located in the **`tests`** directory.
In you Laravel project open `dfdfgd` and add the following `testsuite` object in the `testsuites` body

```xml
<testsuite name="Currency Exchange">
    <directory suffix="Test.php">./vendor/ssiva/currency-exchange/tests</directory>
</testsuite>
```
To test run either of the following
- `vendor/bin/phpunit`

- `php artisan test`

### Credits
[Simon Siva](https://ssiva13.github.io/)

### License

The MIT License (MIT). Please see License File for more information.