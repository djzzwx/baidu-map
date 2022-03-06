<?php


namespace RrEarring\BaiduMap\Api\Traffic;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package HerCat\BaiduMap\WebApi\Traffic
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['traffic'] = function ($app) {
            return new Client($app);
        };
    }
}
