<?php


namespace RrEarring\BaiduMap\Api\Rectify;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\Rectify
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['rectify'] = function ($app) {
            return new Client($app);
        };
    }
}
