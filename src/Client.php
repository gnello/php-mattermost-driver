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

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Pimple\Container;

/**
 * Class Client
 *
 * @package Gnello\Mattermost
 */
class Client
{
    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * Client constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $guzzleOptions = [];
        if (isset($container['guzzle'])) {
            $guzzleOptions = $container['guzzle'];
        }
        $this->client = new GuzzleClient($guzzleOptions);

        $options = $container['driver'];
        $this->baseUri = $options['scheme'] . '://' . $options['url'] . $options['basePath'];
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
     * @param $options
     * @param $type
     * @return array
     */
    private function buildOptions($options, $type)
    {
        return [
            RequestOptions::HEADERS => $this->headers,
            $type => $options,
        ];
    }

    /**
     * @param       $method
     * @param       $uri
     * @param       $type
     * @param array $options
     * @return ResponseInterface
     */
    private function dispatch($method, $uri, $type, array $options = [])
    {
        try {
            $response = $this->client->{$method}($this->makeUri($uri), $this->buildOptions($options, $type));
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            } else {
                $response = new Response(500, [], $e->getMessage());
            }
        }

        return $response;
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function get($uri, array $options = [], $type = RequestOptions::QUERY)
    {
        return $this->dispatch('get', $uri, $type, $options);
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function post($uri, $options = [], $type = RequestOptions::JSON)
    {
        return $this->dispatch('post', $uri, $type, $options);
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function put($uri, $options = [], $type = RequestOptions::JSON)
    {
        return $this->dispatch('put', $uri, $type, $options);
    }

    /**
     * @param        $uri
     * @param array  $options
     * @param string $type
     * @return ResponseInterface
     */
    public function delete($uri, $options = [], $type = RequestOptions::JSON)
    {
        return $this->dispatch('delete', $uri, $type, $options);
    }
}
