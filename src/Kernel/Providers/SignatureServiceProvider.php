<?php

namespace RrEarring\BaiduMap\Kernel\Providers;

use RrEarring\BaiduMap\Kernel\Contracts\Signature;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class SignatureServiceProvider
 * @package HerCat\BaiduMap\Kernel\Providers
 */
class SignatureServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $app['signature'] = function ($app) {
            return new Signature($app);
        };
    }
}
