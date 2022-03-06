<?php

namespace RrEarring\BaiduMap\Kernel\Providers;


use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class HttpClientServiceProvider
 * @package RrEarring\BaiduMap\Kernel\Providers
 */
class HttpClientServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $app['http_client'] = function ($app) {
            return new Client($app->config->get('http', []));
        };
    }
}