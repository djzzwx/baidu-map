<?php

namespace RrEarring\BaiduMap\Api\Timezone;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\WebApi\Timezone
 */
class Client extends BaseClient
{
    /**
     * @param $longitude
     * @param $latitude
     * @param null $timestamp
     * @param string $coordinateType
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($longitude, $latitude, $timestamp = null, $coordinateType = 'bd09ll')
    {
        $params = [
            'location'   => sprintf('%s,%s', $latitude, $longitude),
            'timestamp'  => !is_null($timestamp) ? $timestamp : time(),
            'coord_type' => $coordinateType,
        ];

        return $this->httpGet('timezone/v1', $params);
    }
}
