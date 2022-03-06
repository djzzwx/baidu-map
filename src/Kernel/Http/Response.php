<?php

namespace RrEarring\BaiduMap\Kernel\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use RrEarring\BaiduMap\Kernel\Exceptions\InvalidArgumentException;
use RrEarring\BaiduMap\Kernel\Exceptions\RuntimeException;
use RrEarring\BaiduMap\Kernel\Support\Collection;
use RrEarring\BaiduMap\Kernel\Support\File;
use RrEarring\BaiduMap\Kernel\Support\XML;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package RrEarring\BaiduMap\Kernel\Http
 */
class Response extends GuzzleResponse
{
    /**
     * @return string
     */
    public function getBodyContents(): string
    {
        $this->getBody()->rewind();
        $contents = $this->getBody()->getContents();
        $this->getBody()->rewind();

        return $contents;
    }

    /**
     * @param string $directory
     * @param string $filename
     * @param bool $appendSuffix
     * @return mixed|string
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function save($directory, $filename = '', $appendSuffix = true)
    {
        $this->getBody()->rewind();

        $directory = rtrim($directory, '/');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // @codeCoverageIgnore
        }

        if (!is_writable($directory)) {
            throw new InvalidArgumentException(sprintf("'%s' is not writable.", $directory));
        }

        $contents = $this->getBody()->getContents();

        if (empty($contents) || '{' === $contents[0]) {
            throw new RuntimeException('Invalid media response content.');
        }

        if (empty($filename)) {
            if (preg_match('/filename="(?<filename>.*?)"/', $this->getHeaderLine('Content-Disposition'), $match)) {
                $filename = $match['filename'];
            } else {
                $filename = md5($contents);
            }
        }

        if ($appendSuffix && empty(pathinfo($filename, PATHINFO_EXTENSION))) {
            $filename .= File::getStreamExt($contents);
        }

        file_put_contents($directory . '/' . $filename, $contents);

        return $filename;
    }

    /**
     * @param string $directory
     * @param string $filename
     * @param bool $appendSuffix
     * @return bool|int
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function saveAs($directory, $filename, $appendSuffix = true)
    {
        return $this->save($directory, $filename, $appendSuffix);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return Response
     */
    public static function buildFromPsrResponse(ResponseInterface $response): Response
    {
        return new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * Build to json.
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Build to array.
     * @return array
     */
    public function toArray(): array
    {
        $content = $this->removeControlCharacters($this->getBodyContents());

        if (false !== stripos($this->getHeaderLine('Content-Type'), 'xml') || 0 === stripos($content, '<xml')) {
            return XML::parse($content);
        }

        $array = json_decode($content, true, 512, JSON_BIGINT_AS_STRING);

        if (JSON_ERROR_NONE === json_last_error()) {
            return (array)$array;
        }

        return [];
    }

    /**
     * Get collection data.
     * @return Collection
     */
    public function toCollection(): object
    {
        return new Collection($this->toArray());
    }

    /**
     * @return object
     */
    public function toObject(): object
    {
        return json_decode($this->toJson());
    }

    /**
     * @return bool|string
     */
    public function __toString()
    {
        return $this->getBodyContents();
    }

    /**
     * @param string $content
     * @return string
     */
    protected function removeControlCharacters(string $content): string
    {
        return \preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', $content);
    }
}
