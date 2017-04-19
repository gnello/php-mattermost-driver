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
 * Class AbstractModel
 *
 * @package Gnello\Mattermost
 */
abstract class AbstractModel
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * AbstractModel constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}