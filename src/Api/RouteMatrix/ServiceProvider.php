<?php

namespace RrEarring\BaiduMap\Api\RouteMatrix;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\RouteMatrix
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['route_matrix'] = function ($app) {
            return new Client($app);
        };
    }
}
