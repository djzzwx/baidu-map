<?php

namespace RrEarring\BaiduMap\Api\IpLocation;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\IpLocation
 */
class Client extends BaseClient
{
    /**
     * @param $ip
     * @param $coor
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($ip = '', $coor = 'bd09ll')
    {
        $params = [
            'ip'   => $ip,
            'coor' => $coor
        ];

        return $this->httpGet('location/ip', $params);
    }
}
