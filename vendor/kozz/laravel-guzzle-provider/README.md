# Laravel - Guzzle 6 (or 5) Service Provider
[![Downloads](https://img.shields.io/packagist/dt/kozz/laravel-guzzle-provider.svg)](https://packagist.org/packages/kozz/laravel-guzzle-provider)
[![Version](https://img.shields.io/packagist/v/kozz/laravel-guzzle-provider.svg)](https://packagist.org/packages/kozz/laravel-guzzle-provider)

laravel guzzle service provider

## Install With Composer:

### Guzzle ~5.0
```sh
composer require kozz/laravel-guzzle-provider ~5.0
```

Or manualy in composer.json:
```json
"require": {
    "kozz/laravel-guzzle-provider": "~5.0"
}
```

### Guzzle ~6.0
```sh
composer require kozz/laravel-guzzle-provider ~6.0
```

Or manualy in composer.json:
```json
"require": {
    "kozz/laravel-guzzle-provider": "~6.0"
}
```

## Setup

### Laravel >=5.5

This package supports auto discovery, so no configuration is required.

### Laravel <5.5

#### Register Service Provider

*/configs/app.php*

```php
    ...
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        ...

        /*
         * Application Service Providers...
         */
        ...
        'Kozz\Laravel\Providers\Guzzle'
    ],
```


#### Enable Facade

*/configs/app.php*

```php
    ...
    'aliases' => [
        ...
        'Guzzle' => 'Kozz\Laravel\Facades\Guzzle'
    ],
```

## Usage

### Send request

```php

  $response = \Guzzle::get('https://google.com');
```


### Get instance

```php
    $client = app()->offsetGet('guzzle');
    $client = \Illuminate\Container\Container::getInstance()->offsetGet('guzzle');
    $client = \Kozz\Laravel\Facades\Guzzle::getFacadeRoot();
    $client = \Guzzle::getFacadeRoot();
```
### POST 
```php
$response = Guzzle::post(
    'https://httpbin.org/post',
    [
        'form_params' => [
            'id' => 222
        ]
    ]
);
```

#### Basic auth

```php
$response = Guzzle::post(
    'https://httpbin.org/post',
    [
        'auth' => [ 'theUsername', 'thePassword'],
    ]
);
```


generates: 
`+"Authorization": "Basic dGhlVXNlcm5hbWU6dGhlUGFzc3dvcmQ="`
