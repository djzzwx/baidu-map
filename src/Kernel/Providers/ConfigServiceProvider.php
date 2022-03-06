<?php

namespace RrEarring\BaiduMap\Kernel\Providers;

use RrEarring\BaiduMap\Kernel\Contracts\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ConfigServiceProvider
 * @package RrEarring\BaiduMap\Kernel\Providers
 */
class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $app['config'] = function ($app) {
            return new Config($app->getConfig());
        };
    }
}