<?php
/**
 * This Driver is based entirely on official documentation of the Mattermost Web
 * Services API and you can extend it by following the directives of the documentation.
 *
 * God bless this mess.
 *
 * @author Luca Agnello <luca@gnello.com>
 * @link https://api.mattermost.com/
 */

namespace Gnello\Mattermost\Models;

/**
 * Class SystemModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class SystemModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/system';

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function pingServer()
    {
        return $this->client->get(self::$endpoint . '/ping');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function recycleDatabaseConnections()
    {
        $customEndpoint = '/database';
        return $this->client->post($customEndpoint . '/recycle');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendTestEmail()
    {
        $customEndpoint = '/email';
        return $this->client->post($customEndpoint . '/test');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getConfiguration()
    {
        $customEndpoint = '/config';
        return $this->client->get($customEndpoint);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateConfiguration()
    {
        $customEndpoint = '/config';
        return $this->client->put($customEndpoint);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function reloadConfiguration()
    {
        $customEndpoint = '/config';
        return $this->client->post($customEndpoint . '/reload');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getClientConfiguration(array $requestOptions)
    {
        $customEndpoint = '/config';
        return $this->client->get($customEndpoint . '/client', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getClientLicense(array $requestOptions)
    {
        $customEndpoint = '/license';
        return $this->client->get($customEndpoint . '/client', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAudits(array $requestOptions)
    {
        $customEndpoint = '/audits';
        return $this->client->get($customEndpoint, $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function invalidateAllCaches()
    {
        $customEndpoint = '/caches';
        return $this->client->post($customEndpoint . '/invalidate');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getLogs(array $requestOptions)
    {
        $customEndpoint = '/logs';
        return $this->client->get($customEndpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addLogMessage(array $requestOptions)
    {
        $customEndpoint = '/logs';
        return $this->client->post($customEndpoint, $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getWebRtcToken()
    {
        $customEndpoint = '/webrtc';
        return $this->client->get($customEndpoint . '/token');
    }
}
