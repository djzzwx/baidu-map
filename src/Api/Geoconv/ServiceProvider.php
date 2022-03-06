<?php

namespace RrEarring\BaiduMap\Api\Geoconv;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Geoconv
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['geoconv'] = function ($app) {
            return new Client($app);
        };
    }
}
