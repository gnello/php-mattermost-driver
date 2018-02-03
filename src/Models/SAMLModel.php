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

use Gnello\Mattermost\Client;

/**
 * Class SAMLModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class SAMLModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/saml';

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getMetadata()
    {
        return $this->client->get(self::$endpoint . '/metadata');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadIDPCertificate(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/certificate/idp', $requestOptions, Client::TYPE_MULTIPART);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removeIDPCertificate()
    {
        return $this->client->delete(self::$endpoint . '/certificate/idp');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadPublicCertificate(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/certificate/public', $requestOptions, Client::TYPE_MULTIPART);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removePublicCertificate()
    {
        return $this->client->delete(self::$endpoint . '/certificate/public');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadPrivateCertificate(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/certificate/private', $requestOptions, Client::TYPE_MULTIPART);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removePrivateCertificate()
    {
        return $this->client->delete(self::$endpoint . '/certificate/private');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCertificateStatus()
    {
        return $this->client->get(self::$endpoint . '/certificate/status');
    }
}
