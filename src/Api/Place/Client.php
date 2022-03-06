<?php

namespace RrEarring\BaiduMap\Api\Place;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\Place
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
    public function get($query, $region, $tag = '')
    {
        $params = [
            'query'  => $query,
            'region' => $region,
            'tag'    => $tag,
        ];

        return $this->httpGet('place/v2/search', $params);
    }
}
