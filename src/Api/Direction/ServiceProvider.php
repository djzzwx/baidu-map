<?php

namespace RrEarring\BaiduMap\Api\Direction;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Direction
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['direction'] = function ($app) {
            return new Client($app);
        };
    }
}
