<?php

namespace RrEarring\BaiduMap\Kernel\Contracts;


use Closure;
use Pimple\Container;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware as GuzzleMiddleware;
use Psr\Http\Message\RequestInterface;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use Psr\Log\LogLevel;

/**
 * Class Middleware
 *
 * @package RrEarring\BaiduMap\Kernel\Contracts
 */
class Middleware extends Collection
{
    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * @var bool
     */
    protected $needSignature = true;

    public function __construct(Container $app, array $items = [])
    {
        parent::__construct($items);
        $this->app = $app;
    }

    /**
     * @param BaseClient $client
     */
    public function register(BaseClient $client)
    {
        if ($this->needSignature) {
            $client->pushMiddleware($this->ak(), 'ak');

            if ($this->app->config->has('sk')) {
                $client->pushMiddleware($this->signature(), 'signature');
            }
        }

        $client->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * Attache ak to request.
     *
     * @return Closure
     */
    protected function ak(): Closure
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $request = $this->app->signature->applyAkToRequest($request);

                return $handler($request, $options);
            };
        };
    }

    /**
     * Attache signature to request.
     *
     * @return Closure
     */
    protected function signature(): Closure
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $request = $this->app->signature->applySignatureToRequest($request);

                return $handler($request, $options);
            };
        };
    }

    /**
     * Log the request.
     *
     * @return callable
     */
    protected function logMiddleware(): callable
    {
        $template = $this->app->config->get('http.log_template', MessageFormatter::DEBUG);

        $formatter = new MessageFormatter($template);

        return GuzzleMiddleware::log($this->app->logger, $formatter, LogLevel::DEBUG);
    }
}