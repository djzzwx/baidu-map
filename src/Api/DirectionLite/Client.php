<?php

namespace RrEarring\BaiduMap\Api\DirectionLite;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use RrEarring\BaiduMap\Kernel\Exceptions\RuntimeException;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\DirectionLite
 */
class Client extends BaseClient
{
    const ALLOWED_METHODS = ['driving', 'riding', 'walking', 'transit'];

    /**
     * @param $method
     * @param $origin
     * @param $destination
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws RuntimeException
     */
    public function execute($method, $origin, $destination, $options = [])
    {
        if (!$this->isAllowedMethod($method)) {
            throw new RuntimeException(sprintf('Method named "%s" not found.', $method));
        }

        $options = array_merge([
            'origin'      => implode(',', (array)$origin),
            'destination' => implode(',', (array)$destination),
        ], $options);

        if ($this->app->config->has('sk')) {
            $options['timestamp'] = time();
        }

        return $this->httpGet(sprintf('directionlite/v1/%s', $method), $options);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     * @throws RuntimeException
     */
    public function __call($name, $arguments)
    {
        return $this->execute($name, ...$arguments);
    }

    public function isAllowedMethod($method)
    {
        return \in_array($method, static::ALLOWED_METHODS);
    }
}
