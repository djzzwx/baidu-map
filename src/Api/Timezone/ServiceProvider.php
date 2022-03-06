<?php


namespace RrEarring\BaiduMap\Api\Timezone;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\WebApi\Timezone
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['timezone'] = function ($app) {
            return new Client($app);
        };
    }
}
