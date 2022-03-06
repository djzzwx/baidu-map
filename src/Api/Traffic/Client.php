<?php

namespace RrEarring\BaiduMap\Api\Traffic;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\WebApi\Traffic
 */
class Client extends BaseClient
{
    /**
     * @param string $city
     * @param string $roadName
     *
     * @return array|Response|Collection|mixed|object|ResponseInterface
     *
     * @throws GuzzleException
     */
    public function get($city, $roadName)
    {
        $params = [
            'city'      => $city,
            'road_name' => $roadName,
        ];

        return $this->httpGet('traffic/v1/road', $params);
    }
}
