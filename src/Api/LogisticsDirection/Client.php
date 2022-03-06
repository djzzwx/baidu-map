<?php

namespace RrEarring\BaiduMap\Api\LogisticsDirection;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\LogisticsDirection
 */
class Client extends BaseClient
{
    /**
     * @param $origin
     * @param $destination
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($origin, $destination, array $options = [])
    {
        $options = array_merge([
            'origin'     => is_array($origin) ? implode(',', $origin) : $origin,
            'destination' => is_array($destination) ? implode(',', $destination) : $destination,
        ], $options);

        return $this->httpGet('logistics_direction/v1/truck', $options);
    }

}
