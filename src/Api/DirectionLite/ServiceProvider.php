<?php

namespace RrEarring\BaiduMap\Api\DirectionLite;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package RrEarring\BaiduMap\Api\DirectionLite
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['direction_lite'] = function ($app) {
            return new Client($app);
        };
    }
}
