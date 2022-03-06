<?php


namespace RrEarring\BaiduMap\Api\WeatherAbroad;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\WeatherAbroak
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['weather_abroad'] = function ($app) {
            return new Client($app);
        };
    }
}
