<?php


namespace RrEarring\BaiduMap\Api\ApiTrackanalysis;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\ApiTrackanalysis
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['api_trackanalysis'] = function ($app) {
            return new Client($app);
        };
    }
}
