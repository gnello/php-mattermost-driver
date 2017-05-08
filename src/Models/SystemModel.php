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
    private static $endpointDatabase = '/database';
    private static $endpointEmail = '/email';
    private static $endpointConfig = '/config';
    private static $endpointLicense = '/license';
    private static $endpointAudits = '/audits';
    private static $endpointCaches = '/caches';
    private static $endpointLogs = '/logs';
    private static $endpointWebRtc = '/webrtc';

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
        return $this->client->post(self::$endpointDatabase . '/recycle');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendTestEmail()
    {
        return $this->client->post(self::$endpointEmail . '/test');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getConfiguration()
    {
        return $this->client->get(self::$endpointConfig);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateConfiguration()
    {
        return $this->client->put(self::$endpointConfig);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function reloadConfiguration()
    {
        return $this->client->post(self::$endpointConfig . '/reload');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getClientConfiguration(array $requestOptions)
    {
        return $this->client->get(self::$endpointConfig . '/client', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getClientLicense(array $requestOptions)
    {
        return $this->client->get(self::$endpointLicense . '/client', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAudits(array $requestOptions)
    {
        return $this->client->get(self::$endpointAudits, $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function invalidateAllCaches()
    {
        return $this->client->post(self::$endpointCaches . '/invalidate');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getLogs(array $requestOptions)
    {
        return $this->client->get(self::$endpointLogs, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addLogMessage(array $requestOptions)
    {
        return $this->client->post(self::$endpointLogs, $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getWebRtcToken()
    {
        return $this->client->get(self::$endpointWebRtc . '/token');
    }
}
