<?php

namespace RrEarring\BaiduMap\Kernel\Contracts;

use RrEarring\BaiduMap\Kernel\Providers\ConfigServiceProvider;
use RrEarring\BaiduMap\Kernel\Providers\HttpClientServiceProvider;
use Pimple\Container;
use RrEarring\BaiduMap\Kernel\Providers\LogServiceProvider;
use RrEarring\BaiduMap\Kernel\Providers\MiddlewareServiceProvider;
use RrEarring\BaiduMap\Kernel\Providers\SignatureServiceProvider;

/**
 * Class ServiceContainer
 * @package RrEarring\BaiduMap\Kernel\Contracts
 */
class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultProviders = [
        ConfigServiceProvider::class,
        HttpClientServiceProvider::class,
        MiddlewareServiceProvider::class,
        SignatureServiceProvider::class,
        LogServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * @var array
     */
    protected $defaultConfig = [];

    /**
     * @var array
     */
    protected $httpConfig = [
        'http' => [
            'timeout'  => 10.0,
            'base_uri' => 'http://api.map.baidu.com/',
        ],
    ];

    public function __construct(array $config, array $values = [])
    {
        parent::__construct($values);

        $this->userConfig = $config;

        $this->registerProviders($this->getProviders());
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return array_replace_recursive($this->httpConfig, $this->defaultConfig, $this->userConfig);
    }

    /**
     * @param array $providers
     */
    protected function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

    /**
     * @return array
     */
    protected function getProviders(): array
    {
        return array_merge($this->defaultProviders, $this->providers);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

}