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
 * Class BleveModel
 *
 * @package Gnello\Mattermost\Models
 */
class BleveModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/bleve';

    /**
     * @param $roleId
     * @return ResponseInterface
     */
    public function purgeAllIndexes()
    {
        return $this->client->get(self::$endpoint . '/purge_indexes');
    }
}
