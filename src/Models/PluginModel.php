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
     * @return ResponseInterface
     */
    public function uploadPlugin(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @return ResponseInterface
     */
    public function getPlugins()
    {
        return $this->client->get(self::$endpoint);
    }

    /**
     * @param $pluginId
     * @return ResponseInterface
     */
    public function removePlugin($pluginId)
    {
        return $this->client->delete(self::$endpoint . '/' . $pluginId);
    }

    /**
     * @param $pluginId
     * @return ResponseInterface
     */
    public function activePlugin($pluginId)
    {
        return $this->client->post(self::$endpoint . '/' . $pluginId . '/activate');
    }

    /**
     * @param $pluginId
     * @return ResponseInterface
     */
    public function deactivePlugin($pluginId)
    {
        return $this->client->post(self::$endpoint . '/' . $pluginId . '/deactivate');
    }

    /**
     * @return ResponseInterface
     */
    public function getWebappPlugins()
    {
        return $this->client->get(self::$endpoint . '/webapp');
    }
}
