<?php


namespace RrEarring\BaiduMap\Api\TrackMatch;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\TrackMatch
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['track_match'] = function ($app) {
            return new Client($app);
        };
    }
}
