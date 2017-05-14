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
 * Class ClusterModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class ClusterModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/cluster';

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getClusterStatus()
    {
        return $this->client->get(self::$endpoint . '/status');
    }
}
