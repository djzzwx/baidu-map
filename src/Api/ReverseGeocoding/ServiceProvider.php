<?php

namespace RrEarring\BaiduMap\Api\ReverseGeocoding;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\ReverseGeocoding
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['reverse_geocoding'] = function ($app) {
            return new Client($app);
        };
    }
}
