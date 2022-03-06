<?php

namespace RrEarring\BaiduMap\Api\IpLocation;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\IpLocation
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['ip_location'] = function ($app) {
            return new Client($app);
        };
    }
}
