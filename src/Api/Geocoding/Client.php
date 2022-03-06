<?php

namespace RrEarring\BaiduMap\Api\Geocoding;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\Geocoding
 */
class Client extends BaseClient
{
    /**
     * @param $address
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($address)
    {
        $params = [
            'address' => $address,
        ];

        return $this->httpGet('geocoding/v3', $params);
    }
}
