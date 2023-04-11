## Currency Exchange Package

This package provides a simple API for currency exchange rates using the European Central Bank daily reference rates.

### Installation

You can install the package via composer:

```bash
composer require your-vendor/your-package
```
Next, you need to run the package migration and seeders:

```bash
php artisan migrate
php artisan db:seed --class=CurrencySeeder
```

This will create the necessary database tables and seed the currencies table with default data.

### Usage

To use the package, you can make a GET request to the following endpoint:

```bash
GET /api/exchange?amount=100&currency=USD
```

Where amount is the amount of currency to exchange and currency is the currency to exchange to. If no currency is specified, the default currency (EUR) will be used.

The API will return the exchange rate for the given amount in the specified currency. The response will be in JSON format and will include the exchange rate and the converted amount.

```json
{
    "exchange_rate": 1.1841,
    "amount": 118.41
}
```

### Configuration

You can customize the package configuration by publishing the configuration file:

```bash
php artisan vendor:publish --provider="YourVendor\\YourPackage\\YourPackageServiceProvider" --tag="config"
````
This will create a your-package.php file in your Laravel config directory where you can configure the package settings.

### Testing

You can run the package tests using PHPUnit. The tests are located in the tests directory.

```bash
vendor/bin/phpunit
```
### Credits

Simon Siva

### License

The MIT License (MIT). Please see License File for more information.