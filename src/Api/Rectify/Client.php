<?php

namespace RrEarring\BaiduMap\Api\Rectify;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\Rectify
 */
class Client extends BaseClient
{
    /**
     * @param $points
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($points, array $options = [])
    {
        $options = array_merge([
            'point_list' => is_array($points) ? json_encode($points) : $points,
        ], $options);

        return $this->httpPost('rectify/v1/track', $options);
    }
}
