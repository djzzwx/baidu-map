<?php

namespace RrEarring\BaiduMap\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RrEarring\BaiduMap\Kernel\Contracts\Middleware;

/**
 * Class MiddlewareServiceProvider
 * @package RrEarring\BaiduMap\Kernel\Providers
 */
class MiddlewareServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $app['middleware'] = function ($app) {
            return new Middleware($app);
        };
    }
}