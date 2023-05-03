<?php
/**
 * This Driver is based entirely on official documentation of the Mattermost Web
 * Services API and you can extend it by following the directives of the documentation.
 *
 * For the full copyright and license information, please read the LICENSE.txt
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/gnello/php-mattermost-driver/contributors
 *
 * God bless this mess.
 *
 * @author Luca Agnello <luca@gnello.com>
 * @link https://api.mattermost.com/
 */

namespace Gnello\Mattermost;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Nyholm\Psr7\Uri;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class Client
 *
 * @package Gnello\Mattermost
 */
class Client
{
    const REQUEST_JSON = 'json';
    const REQUEST_QUERY = 'query';
    const REQUEST_MULTIPART = 'multipart';

    /** @var string */
    private $baseUri;

    /** @var array */
    private $headers = [];

    /** @var ClientInterface */
    private $client;

    /** @var RequestFactoryInterface */
    private $requestFactory;
    /** @var StreamFactoryInterface */
    private $streamFactory;

    /** @param array<string, ?string> $options */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        string $baseUrl
    ) {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->baseUri = $baseUrl;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->headers = ['Authorization' => 'Bearer ' . $token];
    }

    /**
     * @param $uri
     * @return string
     */
    private function makeUri($uri)
    {
        return $this->baseUri . $uri;
    }

    /**
     * @param       $method
     * @param       $uri
     * @param       $type
     * @param array $options
     * @return ResponseInterface
     */
    private function dispatch(string $method, string $uri, string $type, array $options = [])
    {
        $method = strtoupper($method);
        $request = $this->requestFactory->createRequest($method, $this->makeUri($uri));

        foreach ($this->headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        switch ($type) {
            case self::REQUEST_JSON:
                $request = $request->withHeader('Content-Type', 'application/json');
                $request = $request->withBody($this->streamFactory->createStream((string) \json_encode($options, \JSON_THROW_ON_ERROR)));
                break;

            case self::REQUEST_MULTIPART:
                $builder = new MultipartStreamBuilder($this->streamFactory);

                foreach ($options as $value) {
                    $builder = $builder->addResource($value['name'], $value['contents'], isset($value['filename']) ? [
                        'filename' => $value['filename'],
                    ] : []);
                }

                $request = $request->withBody($builder->build());
                $request = $request->withHeader('Content-type', 'multipart/form-data; boundary="' . $builder->getBoundary() . '"');
                break;

            case self::REQUEST_QUERY:
                $request = $request->withUri(new Uri($this->makeUri($uri) . '?' . \http_build_query($options, '', '&', \PHP_QUERY_RFC3986)));
                break;

            default:
                throw new \RuntimeException("Unexpected type {$type}");
        }

        $response = $this->client->sendRequest($request);

        return $response;
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function get($uri, array $options = [], $type = self::REQUEST_QUERY)
    {
        return $this->dispatch('get', $uri, $type, $options);
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function post($uri, $options = [], $type = self::REQUEST_JSON)
    {
        return $this->dispatch('post', $uri, $type, $options);
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function put($uri, $options = [], $type = self::REQUEST_JSON)
    {
        return $this->dispatch('put', $uri, $type, $options);
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function delete($uri, $options = [], $type = self::REQUEST_JSON)
    {
        return $this->dispatch('delete', $uri, $type, $options);
    }
}
