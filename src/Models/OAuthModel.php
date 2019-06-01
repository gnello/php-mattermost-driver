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

use Psr\Http\Message\ResponseInterface;

/**
 * Class OAuthModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class OAuthModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/oauth';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function registerOAuthApp(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/apps', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getOAuthApps(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/apps', $requestOptions);
    }

    /**
     * @param $appId
     * @return ResponseInterface
     */
    public function getOAuthApp($appId)
    {
        return $this->client->get(self::$endpoint . '/apps/' . $appId);
    }

    /**
     * @param $appId
     * @return ResponseInterface
     */
    public function deleteOAuthApp($appId)
    {
        return $this->client->delete(self::$endpoint . '/apps/' . $appId);
    }

    /**
     * @param $appId
     * @return ResponseInterface
     */
    public function regenerateOAuthAppSecret($appId)
    {
        return $this->client->post(self::$endpoint . '/apps/' . $appId . '/regen_secret');
    }

    /**
     * @param $appId
     * @return ResponseInterface
     */
    public function getOAuthAppInfo($appId)
    {
        return $this->client->get(self::$endpoint . '/apps/' . $appId . '/info');
    }

    /**
     * @param $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getAuthorizedOAuthApps($userId, array $requestOptions)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/oauth/apps/authorized', $requestOptions);
    }
}
