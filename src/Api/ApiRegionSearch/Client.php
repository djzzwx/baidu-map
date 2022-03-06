<?php

namespace RrEarring\BaiduMap\Api\ApiRegionSearch;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Contracts\BaseClient;
use RrEarring\BaiduMap\Kernel\Http\Response;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package RrEarring\BaiduMap\Api\ApiRegionSearch
 */
class Client extends BaseClient
{
    /**
     * @param $keyword
     * @param array $options
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function get($keyword, $options = [])
    {
        $options = array_merge([
            'keyword' => $keyword,
        ], $options);

        return $this->httpGet('api_region_search/v1/', $options);
    }
}
