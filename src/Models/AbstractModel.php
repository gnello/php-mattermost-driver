<?php
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