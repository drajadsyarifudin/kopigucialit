<?php
namespace Kozz\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class Guzzle extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('guzzle', function () {
            $config = isset($this->app['config']['guzzle']) ? $this->app['config']['guzzle'] : [];
            return new Client($config);
        });
    }
}
