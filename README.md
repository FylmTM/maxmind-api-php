Maxmind API
===============
[![Build Status](https://travis-ci.org/FylmTM/maxmind-api-php.png?branch=master)](https://travis-ci.org/FylmTM/maxmind-api-php)
[![Coverage Status](https://coveralls.io/repos/FylmTM/maxmind-api-php/badge.png?branch=master)](https://coveralls.io/r/FylmTM/maxmind-api-php?branch=master)
[![Latest Stable Version](https://poser.pugx.org/fylmtm/maxmind-api/v/stable.png)](https://packagist.org/packages/fylmtm/maxmind-api)
[![Total Downloads](https://poser.pugx.org/fylmtm/maxmind-api/downloads.png)](https://packagist.org/packages/fylmtm/maxmind-api)
[![Latest Unstable Version](https://poser.pugx.org/fylmtm/maxmind-api/v/unstable.png)](https://packagist.org/packages/fylmtm/maxmind-api)
[![License](https://poser.pugx.org/fylmtm/maxmind-api/license.png)](https://packagist.org/packages/fylmtm/maxmind-api)

# About
**Author**: Dmitry Vrublevskis

**Email**: d.vrublevskis@gmail.com

# Installation
### Composer
Recommended way of installation is through [composer](http://getcomposer.org/).
Add to your composer.json:
```javascript
"require": {
    "fylmtm/maxmind-api": "0.1.*@dev"
}
```
And then install with:
```bash
$ composer.phar install
```

### Manual
You can manually download library and use autoloader.
```php
require_once 'lib/autoloader.php'
```

# Usage

## MinFraud client
Create client:
```php
$fraudClient = new Maxmind\MinFraud\MinFraudClient();
```

By default main server used. You can choose whatever you want:
```php
$fraudClient->setServer(\Maxmind\MinFraud\MinFraudServers::MAIN);
$fraudClient->setServer(\Maxmind\MinFraud\MinFraudServers::US_EAST);
$fraudClient->setServer(\Maxmind\MinFraud\MinFraudServers::US_WEST);
```

## MinFraud request
[minFraud API reference](http://dev.maxmind.com/minfraud/)

You need to create request, which you pass to fraudClient later. Required request fields must be passed on client creation. By default `standard` request type used.
```php
// Exception may be thrown, if any of required fields will not be passed.
$request = new Maxmind\MinFraud\MinFraudRequest([
    'license_key' => '1111111',
    'i'           => '257.257.257.257',
    'city'        => 'BigApple',
    'region'      => 'NA',
    'postal'      => '1111',
    'country'     => 'NA',
]);
$request->setRequestType('standard'); // 'standard' or 'premium' request type can be used.
```

Other fields (see API reference for more info) can be passed separately.
```php
$request->setShippingAddress([
    'shipAddr' => '',
    'shipCity' => '',
    'shipRegion' => '',
    'shipPostal' => '',
    'shipCountry' => ''
]);
$request->setUserData([
    'domain' => '',
    'custPhone' => '',
    'emailMD5' => '',
    'usernameMD5' => '',
    'passwordMD5' => ''
]);
$request->setBinRelated([
    'bin' => '',
    'binName' => '',
    'binPhone' => ''
]);
$request->setTransactionLinking([
    'sessionID' => '',
    'user_agent' => '',
    'accept_language' => ''
]);
$request->setTransactionInformation([
    'txnID' => '',
    'order_amount' => '',
    'order_currency' => '',
    'shopID' => '',
    'txn_type' => ''
]);
$request->setMisc([
    'forwardedIP' => ''
]);
```

## MinFraud response
Request can be executed via client.
```php
$response = $fraudClient->executeRequest($request);
$response->getIsCurlSuccessful(); // true|false - indicates if curl was successfull
$response->getRawResult(); // string - raw curl response, contains error if curl was unsuccessful
$response->getResult(); // parsed minFraud response
```

# Tests
If you wish to run tests, you need to install development dependencies:
```bash
$ composer.phar install --dev
```
And then run them with:
```bash
$ vendor/bin/phpunit
```