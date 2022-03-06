<?php

namespace RrEarring\BaiduMap\Api\RouteMatrix;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\RouteMatrix
 */
class Client extends BaseClient
{
    /**
     * @param $origins
     * @param $destinations
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function driving($origins, $destinations, array $options = [])
    {
        $options = array_merge([
            'origins'      => $this->processCoordinate($origins),
            'destinations' => $this->processCoordinate($destinations),
        ], $options);

        return $this->httpGet('routematrix/v2/driving', $options);
    }

    /**
     * @param $origins
     * @param $destinations
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function riding($origins, $destinations, array $options = [])
    {
        $options = array_merge([
            'origins'      => $this->processCoordinate($origins),
            'destinations' => $this->processCoordinate($destinations),
        ], $options);

        return $this->httpGet('routematrix/v2/riding', $options);
    }

    /**
     * @param $origins
     * @param $destinations
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function walking($origins, $destinations, array $options = [])
    {
        $options = array_merge([
            'origins'      => $this->processCoordinate($origins),
            'destinations' => $this->processCoordinate($destinations),
        ], $options);

        return $this->httpGet('routematrix/v2/walking', $options);
    }

    /**
     * @param $coordinate
     *
     * @return array|string
     */
    protected function processCoordinate($coordinate)
    {
        if (is_object($coordinate)) {
            $coordinate = (array)$coordinate;
        } elseif (!is_array($coordinate)) {
            return $coordinate;
        }

        $coordinate = array_map(function ($value) {
            return is_array($value) ? implode(',', $value) : $value;
        }, $coordinate);

        return implode('|', $coordinate);
    }
}
