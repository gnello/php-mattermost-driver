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

use Gnello\Mattermost\Models\BrandModel;
use Gnello\Mattermost\Models\ChannelModel;
use Gnello\Mattermost\Models\ClusterModel;
use Gnello\Mattermost\Models\CommandModel;
use Gnello\Mattermost\Models\ComplianceModel;
use Gnello\Mattermost\Models\FileModel;
use Gnello\Mattermost\Models\LDAPModel;
use Gnello\Mattermost\Models\OAuthModel;
use Gnello\Mattermost\Models\PostModel;
use Gnello\Mattermost\Models\PreferenceModel;
use Gnello\Mattermost\Models\SAMLModel;
use Gnello\Mattermost\Models\SystemModel;
use Gnello\Mattermost\Models\TeamModel;
use Gnello\Mattermost\Models\UserModel;
use Gnello\Mattermost\Models\WebhookModel;
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
        'basePath'  => '/api/v4',
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
        $requestOptions = [
            'login_id' => $driverOptions['login_id'],
            'password' => $driverOptions['password']
        ];

        $response = $this->getUserModel()->loginToUserAccount($requestOptions);

        if ($response->getStatusCode() == 200) {
            $token = $response->getHeader('Token')[0];
            $this->container['client']->setToken($token);
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
     * @return ChannelModel
     */
    public function getChannelModel()
    {
        if (!isset($this->models['channel'])) {
            $this->models['channel'] = new ChannelModel($this->container['client']);
        }

        return $this->models['channel'];
    }

    /**
     * @return PostModel
     */
    public function getPostModel()
    {
        if (!isset($this->models['post'])) {
            $this->models['post'] = new PostModel($this->container['client']);
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

    /**
     * @param $userId
     * @return PreferenceModel
     */
    public function getPreferenceModel($userId)
    {
        if (!isset($this->models['preference'])) {
            $this->models['preference'] = new PreferenceModel($this->container['client'], $userId);
        }

        return $this->models['preference'];
    }

    /**
     * @return WebhookModel
     */
    public function getWebhookModel()
    {
        if (!isset($this->models['webhook'])) {
            $this->models['webhook'] = new WebhookModel($this->container['client']);
        }

        return $this->models['webhook'];
    }

    /**
     * @return SystemModel
     */
    public function getSystemModel()
    {
        if (!isset($this->models['system'])) {
            $this->models['system'] = new SystemModel($this->container['client']);
        }

        return $this->models['system'];
    }

    /**
     * @return ComplianceModel
     */
    public function getComplianceModel()
    {
        if (!isset($this->models['compliance'])) {
            $this->models['compliance'] = new ComplianceModel($this->container['client']);
        }

        return $this->models['compliance'];
    }

    /**
     * @return CommandModel
     */
    public function getCommandModel()
    {
        if (!isset($this->models['command'])) {
            $this->models['command'] = new CommandModel($this->container['client']);
        }

        return $this->models['command'];
    }

    /**
     * @return ClusterModel
     */
    public function getClusterModel()
    {
        if (!isset($this->models['cluster'])) {
            $this->models['cluster'] = new ClusterModel($this->container['client']);
        }

        return $this->models['cluster'];
    }

    /**
     * @return BrandModel
     */
    public function getBrandModel()
    {
        if (!isset($this->models['brand'])) {
            $this->models['brand'] = new BrandModel($this->container['client']);
        }

        return $this->models['brand'];
    }

    /**
     * @return LDAPModel
     */
    public function getLDAPModel()
    {
        if (!isset($this->models['ldap'])) {
            $this->models['ldap'] = new LDAPModel($this->container['client']);
        }

        return $this->models['ldap'];
    }

    /**
     * @return OAuthModel
     */
    public function getOAuthModel()
    {
        if (!isset($this->models['oauth'])) {
            $this->models['oauth'] = new OAuthModel($this->container['client']);
        }

        return $this->models['oauth'];
    }

    /**
     * @return SAMLModel
     */
    public function getSAMLModel()
    {
        if (!isset($this->models['saml'])) {
            $this->models['saml'] = new SAMLModel($this->container['client']);
        }

        return $this->models['saml'];
    }
}
