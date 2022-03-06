<?php

namespace RrEarring\BaiduMap\Api\Weather;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\Weather
 */
class Client extends BaseClient
{
    /**
     * @param $dataType
     * @param array $options
     * @return array|mixed|object|ResponseInterface|Response|Collection
     * @throws GuzzleException
     */
    public function get($dataType, $options = [])
    {
        $options = array_merge([
            'data_type' => $dataType,
        ], $options);

        return $this->httpGet('weather/v1/', $options);
    }
}
