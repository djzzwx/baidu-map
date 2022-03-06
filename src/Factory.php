<?php

namespace RrEarring\BaiduMap;

use RrEarring\BaiduMap\Api\Application;
use RrEarring\BaiduMap\Kernel\Exceptions\RuntimeException;

/**
 * Class Factory
 * @package RrEarring\Map
 *
 * @method static Api\Application baiduApi(array $config)
 */
class Factory
{
    protected static $services = [
        'baiduApi' => Application::class,
    ];

    /**
     * @param $name
     * @param array $config
     * @return mixed
     * @throws RuntimeException
     */
    public static function make($name, array $config)
    {
        if (isset(self::$services[$name])) {
            return new self::$services[$name]($config);
        }

        throw new RuntimeException(sprintf('No service named "%s".', $name));
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws RuntimeException
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}