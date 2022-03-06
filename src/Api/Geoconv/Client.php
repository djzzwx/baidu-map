<?php

namespace RrEarring\BaiduMap\Api\Geoconv;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\Geoconv
 */
class Client extends BaseClient
{
    /**
     * @param $query
     * @param $region
     * @param $tag
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($coords, $from = 1, $to = 5)
    {
        $params = [
            'coords' => is_array($coords) ? implode(';', $coords) : $coords,
            'from'   => $from,
            'to'     => $to,
        ];

        return $this->httpGet('geoconv/v1/', $params);
    }
}
