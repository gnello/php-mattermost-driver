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
 * Class SchemeModel
 *
 * @package Gnello\Mattermost\Models
 */
class SchemeModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/schemes';

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSchemes()
    {
        return $this->client->get(self::$endpoint);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createScheme(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param $schemeId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getScheme($schemeId)
    {
        return $this->client->get(self::$endpoint . '/' . $schemeId);
    }

    /**
     * @param $schemeId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteScheme($schemeId)
    {
        return $this->client->delete(self::$endpoint . '/' . $schemeId);
    }

    /**
     * @param       $schemeId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patchScheme($schemeId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $schemeId . '/patch', $requestOptions);
    }

    /**
     * @param       $schemeId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamsOfScheme($schemeId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $schemeId . '/teams', $requestOptions);
    }

    /**
     * @param       $schemeId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelsOfScheme($schemeId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $schemeId . '/channels', $requestOptions);
    }
}
