<?php

namespace RrEarring\BaiduMap\Api\ReverseGeocoding;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\ReverseGeocoding
 */
class Client extends BaseClient
{
    /**
     * @param $longitude
     * @param $latitude
     * @param string $coordinateType
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($longitude, $latitude, $coordinateType = 'bd09ll')
    {
        $params = [
            'location'   => sprintf('%s,%s', $latitude, $longitude),
            'coord_type' => $coordinateType,
        ];

        return $this->httpGet('reverse_geocoding/v3', $params);
    }
}
