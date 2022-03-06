<?php

namespace RrEarring\BaiduMap\Api\Place;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Place
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['place'] = function ($app) {
            return new Client($app);
        };
    }
}
