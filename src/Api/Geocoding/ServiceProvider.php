<?php

namespace RrEarring\BaiduMap\Api\Geocoding;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Geocoding
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['geocoding'] = function ($app) {
            return new Client($app);
        };
    }
}
