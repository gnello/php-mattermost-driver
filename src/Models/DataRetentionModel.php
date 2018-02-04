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
 * Class DataRetentionModel
 *
 * @package Gnello\Mattermost\Models
 */
class DataRetentionModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/data_retention';

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPolicyDetails()
    {
        return $this->client->get(self::$endpoint . '/policy');
    }
}
