<?php
namespace Gnello\Mattermost;

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
     * @return bool
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
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $token = $response->getHeader('Token')[0];
            $client->setToken($token);

            return true;
        }

        return false;
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
}