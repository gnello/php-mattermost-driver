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

namespace Gnello\Mattermost;

use Gnello\Mattermost\Models\ChannelModel;
use Gnello\Mattermost\Models\FileModel;
use Gnello\Mattermost\Models\PostModel;
use Gnello\Mattermost\Models\TeamModel;
use Gnello\Mattermost\Models\UserModel;
use Pimple\Container;

/**
 * Class Driver
 *
 * @package Gnello\Mattermost
 */
class Driver
{
    /**
     * Default options of the Driver
     *
     * @var array
     */
    private $defaultOptions = [
        'scheme'    => 'https',
        'basePath'  => '/api/v3',
        'url'       => 'localhost',
        'login_id'  => null,
        'password'  => null,
    ];

    /**
     * @var Container
     */
    private $container;

    /**
     * @var array
     */
    private $models = [];

    /**
     * Driver constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $driverOptions = $this->defaultOptions;
        if (isset($container['driver'])) {
            $driverOptions = array_merge($driverOptions, $container['driver']);
        }
        $container['driver'] = $driverOptions;
        $container['client'] = new Client($container);

        $this->container = $container;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function authenticate()
    {
        $driverOptions = $this->container['driver'];
        $options = [
            'login_id' => $driverOptions['login_id'],
            'password' => $driverOptions['password']
        ];

        /** @var Client $client */
        $client = $this->container['client'];
        $response = $client->post('/users/login', $options);

        if ($response->getStatusCode() == 200) {
            $token = $response->getHeader('Token')[0];
            $client->setToken($token);
        }

        return $response;
    }

    /**
     * @return UserModel
     */
    public function getUserModel()
    {
        if (!isset($this->models['user'])) {
            $this->models['user'] = new UserModel($this->container['client']);
        }

        return $this->models['user'];
    }

    /**
     * @return TeamModel
     */
    public function getTeamModel()
    {
        if (!isset($this->models['team'])) {
            $this->models['team'] = new TeamModel($this->container['client']);
        }

        return $this->models['team'];
    }

    /**
     * @param $teamId
     * @return ChannelModel
     */
    public function getChannelModel($teamId)
    {
        if (!isset($this->models['channel'])) {
            $this->models['channel'] = new ChannelModel($this->container['client'], $teamId);
        }

        return $this->models['channel'];
    }

    /**
     * @param $teamId
     * @return PostModel
     */
    public function getPostModel($teamId)
    {
        if (!isset($this->models['post'])) {
            $this->models['post'] = new PostModel($this->container['client'], $teamId);
        }

        return $this->models['post'];
    }

    /**
     * @return FileModel
     */
    public function getFileModel()
    {
        if (!isset($this->models['file'])) {
            $this->models['file'] = new FileModel($this->container['client']);
        }

        return $this->models['file'];
    }
}