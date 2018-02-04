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
 * Class PluginModel
 *
 * @package Gnello\Mattermost\Models
 */
class PluginModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/plugins';

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadPlugin(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions, Client::TYPE_MULTIPART);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPlugins()
    {
        return $this->client->get(self::$endpoint);
    }

    /**
     * @param $pluginId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removePlugin($pluginId)
    {
        return $this->client->delete(self::$endpoint . '/' . $pluginId);
    }

    /**
     * @param $pluginId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function activePlugin($pluginId)
    {
        return $this->client->post(self::$endpoint . '/' . $pluginId . '/activate');
    }

    /**
     * @param $pluginId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deactivePlugin($pluginId)
    {
        return $this->client->post(self::$endpoint . '/' . $pluginId . '/deactivate');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getWebappPlugins()
    {
        return $this->client->get(self::$endpoint . '/webapp');
    }
}
