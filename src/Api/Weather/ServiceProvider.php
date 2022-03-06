<?php


namespace RrEarring\BaiduMap\Api\Weather;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Weather
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['weather'] = function ($app) {
            return new Client($app);
        };
    }
}
