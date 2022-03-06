<?php

namespace RrEarring\BaiduMap\Kernel\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use RrEarring\BaiduMap\Kernel\Http\Request;
use RrEarring\BaiduMap\Kernel\Http\Response;
use Psr\Http\Message\ResponseInterface;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use RrEarring\BaiduMap\Kernel\Exceptions\InvalidConfigException;

/**
 * Class BaseClient
 * @package RrEarring\BaiduMap\Kernel\Contracts
 */
class BaseClient extends Request
{
    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * BaseClient constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @param $url
     * @param array $query
     *
     * @return array|mixed|object|ResponseInterface|Response|Collection
     *
     * @throws GuzzleException
     */
    public function httpGet($url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    /**
     * @param string $url
     * @param array $params
     *
     * @return array|Response|Collection|mixed|object|ResponseInterface
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function httpPost($url, array $params = [])
    {
        return $this->request($url, 'POST', ['form_params' => $params]);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $query
     *
     * @return array|Response|Collection|mixed|object|ResponseInterface
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function httpPostJson($url, array $params = [], array $query = [])
    {
        return $this->request($url, 'POST', ['json' => $params, 'query' => $query]);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $params
     *
     * @return array|Response|Collection|object|ResponseInterface
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function httpGetStream($url, $method = 'GET', array $params = [])
    {
        $options = ('GET' == strtoupper($method))
            ? ['query' => $params]
            : ['form_params' => $params];

        $response = $this->request($url, $method, $options, true);

        if (false !== stripos($response->getHeaderLine('Content-Type'), 'image')) {
            return Response::buildFromPsrResponse($response);
        }

        return $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @param bool $returnRaw
     *
     * @return array|Response|Collection|mixed|object|ResponseInterface
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function request($url, $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = parent::request($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     *
     * @return Response
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function requestRaw($url, $method = 'GET', array $options = []): Response
    {
        return Response::buildFromPsrResponse($this->request($url, $method, $options, true));
    }

    /**
     * Register Guzzle middleware.
     */
    protected function registerHttpMiddlewares()
    {
        $this->app->middleware->register($this);
    }
}
