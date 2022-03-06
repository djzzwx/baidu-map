<?php

namespace RrEarring\BaiduMap\Api\LogisticsDirection;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\LogisticsDirection
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['logistics_direction'] = function ($app) {
            return new Client($app);
        };
    }
}
