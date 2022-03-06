<?php


namespace RrEarring\BaiduMap\Api\ApiRegionSearch;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\ApiRegionSearch
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['api_region_search'] = function ($app) {
            return new Client($app);
        };
    }
}
