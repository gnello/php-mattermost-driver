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

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

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
     * @return ResponseInterface
     */
    public function pingServer()
    {
        return $this->client->get(self::$endpoint . '/ping');
    }

    /**
     * @return ResponseInterface
     */
    public function recycleDatabaseConnections()
    {
        $customEndpoint = '/database';
        return $this->client->post($customEndpoint . '/recycle');
    }

    /**
     * @return ResponseInterface
     */
    public function sendTestEmail()
    {
        $customEndpoint = '/email';
        return $this->client->post($customEndpoint . '/test');
    }

    /**
     * @return ResponseInterface
     */
    public function getConfiguration()
    {
        $customEndpoint = '/config';
        return $this->client->get($customEndpoint);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateConfiguration(array $requestOptions)
    {
        $customEndpoint = '/config';
        return $this->client->put($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function reloadConfiguration()
    {
        $customEndpoint = '/config';
        return $this->client->post($customEndpoint . '/reload');
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getClientConfiguration(array $requestOptions)
    {
        $customEndpoint = '/config';
        return $this->client->get($customEndpoint . '/client', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function patchConfiguration(array $requestOptions)
    {
        $customEndpoint = '/config';
        return $this->client->put($customEndpoint . '/patch', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return ResponseInterface
     */
    public function getClientLicense(array $requestOptions)
    {
        $customEndpoint = '/license';
        return $this->client->get($customEndpoint . '/client', $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function removeLicenseFile()
    {
        $customEndpoint = '/license';
        return $this->client->delete($customEndpoint);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function uploadLicenseFile(array $requestOptions)
    {
        $customEndpoint = '/license';
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['license']);

        return $this->client->post($customEndpoint, $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getAudits(array $requestOptions)
    {
        $customEndpoint = '/audits';
        return $this->client->get($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function invalidateAllCaches()
    {
        $customEndpoint = '/caches';
        return $this->client->post($customEndpoint . '/invalidate');
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getLogs(array $requestOptions)
    {
        $customEndpoint = '/logs';
        return $this->client->get($customEndpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function addLogMessage(array $requestOptions)
    {
        $customEndpoint = '/logs';
        return $this->client->post($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function getWebRtcToken()
    {
        $customEndpoint = '/webrtc';
        return $this->client->get($customEndpoint . '/token');
    }

    /**
     * @return ResponseInterface
     */
    public function getAnalytics()
    {
        $customEndpoint = '/analytics';
        return $this->client->get($customEndpoint . '/old');
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function setServerBusyFlag(array $requestOptions)
    {
        $customEndpoint = '/server_busy';
        return $this->client->post($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function getServerBusyExpiryTime()
    {
        $customEndpoint = '/server_busy';
        return $this->client->get($customEndpoint);
    }

    /**
     * @return ResponseInterface
     */
    public function clearServerBusyFlag()
    {
        $customEndpoint = '/server_busy';
        return $this->client->delete($customEndpoint);
    }
}
