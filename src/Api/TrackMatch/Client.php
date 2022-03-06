<?php

namespace RrEarring\BaiduMap\Api\TrackMatch;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\TrackMatch
 */
class Client extends BaseClient
{
    /**
     * @param $origin
     * @param $target
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($origin, $target, array $options = [])
    {
        $options = array_merge([
            'standard_track' => is_array($origin) ? json_encode($origin) : $origin,
            'track'          => is_array($target) ? json_encode($target) : $target,
        ], $options);

        return $this->httpPost('trackmatch/v1/track', $options);
    }
}
