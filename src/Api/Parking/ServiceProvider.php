<?php


namespace RrEarring\BaiduMap\Api\Parking;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Parking
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['parking'] = function ($app) {
            return new Client($app);
        };
    }
}
