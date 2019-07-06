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
use Gnello\Mattermost\Models\DataRetentionModel;
use Gnello\Mattermost\Models\ElasticsearchModel;
use Gnello\Mattermost\Models\EmojiModel;
use Gnello\Mattermost\Models\FileModel;
use Gnello\Mattermost\Models\JobModel;
use Gnello\Mattermost\Models\LDAPModel;
use Gnello\Mattermost\Models\OAuthModel;
use Gnello\Mattermost\Models\PluginModel;
use Gnello\Mattermost\Models\PostModel;
use Gnello\Mattermost\Models\PreferenceModel;
use Gnello\Mattermost\Models\ReactionModel;
use Gnello\Mattermost\Models\RoleModel;
use Gnello\Mattermost\Models\SAMLModel;
use Gnello\Mattermost\Models\SchemeModel;
use Gnello\Mattermost\Models\SystemModel;
use Gnello\Mattermost\Models\TeamModel;
use Gnello\Mattermost\Models\UserModel;
use Gnello\Mattermost\Models\WebhookModel;
use GuzzleHttp\Psr7\Response;
use Pimple\Container;
use Psr\Http\Message\ResponseInterface;

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
        'scheme' => 'https',
        'basePath' => '/api/v4',
        'url' => 'localhost',
        'login_id' => null,
        'password' => null,
        'token' => null,
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
     * @return ResponseInterface
     */
    public function authenticate()
    {
        $driverOptions = $this->container['driver'];

        if (isset($driverOptions['token'])) {

            $this->container['client']->setToken($driverOptions['token']);
            $response = $this->getUserModel()->getAuthenticatedUser();

        } else if (isset($driverOptions['login_id']) && isset($driverOptions['password'])) {

            $response = $this->getUserModel()->loginToUserAccount([
                'login_id' => $driverOptions['login_id'],
                'password' => $driverOptions['password']
            ]);

            if ($response->getStatusCode() == 200) {
                $token = $response->getHeader('Token')[0];
                $this->container['client']->setToken($token);
            }

        } else {

            $response = new Response(401, [], json_encode([
                "id" => "missing.credentials.",
                "message" => "You must provide a login_id and password or a valid token.",
                "detailed_error" => "",
                "request_id" => "",
                "status_code" => 401,
            ]));

        }

        return $response;
    }

    /**
     * @param $className
     * @return mixed
     */
    private function getModel($className)
    {
        if (!isset($this->models[$className])) {
            $this->models[$className] = new $className($this->container['client']);
        }

        return $this->models[$className];
    }

    /**
     * @return UserModel
     */
    public function getUserModel()
    {
        return $this->getModel(UserModel::class);
    }

    /**
     * @return TeamModel
     */
    public function getTeamModel()
    {
        return $this->getModel(TeamModel::class);
    }

    /**
     * @return ChannelModel
     */
    public function getChannelModel()
    {
        return $this->getModel(ChannelModel::class);
    }

    /**
     * @return PostModel
     */
    public function getPostModel()
    {
        return $this->getModel(PostModel::class);
    }

    /**
     * @return FileModel
     */
    public function getFileModel()
    {
        return $this->getModel(FileModel::class);
    }

    /**
     * @param $userId
     * @return PreferenceModel
     */
    public function getPreferenceModel($userId)
    {
        if (!isset($this->models[PreferenceModel::class])) {
            $this->models[PreferenceModel::class] = new PreferenceModel($this->container['client'], $userId);
        }

        return $this->models[PreferenceModel::class];
    }

    /**
     * @return WebhookModel
     */
    public function getWebhookModel()
    {
        return $this->getModel(WebhookModel::class);
    }

    /**
     * @return SystemModel
     */
    public function getSystemModel()
    {
        return $this->getModel(SystemModel::class);
    }

    /**
     * @return ComplianceModel
     */
    public function getComplianceModel()
    {
        return $this->getModel(ComplianceModel::class);
    }

    /**
     * @return CommandModel
     */
    public function getCommandModel()
    {
        return $this->getModel(CommandModel::class);
    }

    /**
     * @return ClusterModel
     */
    public function getClusterModel()
    {
        return $this->getModel(ClusterModel::class);
    }

    /**
     * @return BrandModel
     */
    public function getBrandModel()
    {
        return $this->getModel(BrandModel::class);
    }

    /**
     * @return LDAPModel
     */
    public function getLDAPModel()
    {
        return $this->getModel(LDAPModel::class);
    }

    /**
     * @return OAuthModel
     */
    public function getOAuthModel()
    {
        return $this->getModel(OAuthModel::class);
    }

    /**
     * @return SAMLModel
     */
    public function getSAMLModel()
    {
        return $this->getModel(SAMLModel::class);
    }

    /**
     * @return ElasticsearchModel
     */
    public function getElasticsearchModel()
    {
        return $this->getModel(ElasticsearchModel::class);
    }

    /**
     * @return EmojiModel
     */
    public function getEmojiModel()
    {
        return $this->getModel(EmojiModel::class);
    }

    /**
     * @return ReactionModel
     */
    public function getReactionModel()
    {
        return $this->getModel(ReactionModel::class);
    }

    /**
     * @return DataRetentionModel
     */
    public function getDataRetentionModel()
    {
        return $this->getModel(DataRetentionModel::class);
    }

    /**
     * @return JobModel
     */
    public function getJobModel()
    {
        return $this->getModel(JobModel::class);
    }

    /**
     * @return PluginModel
     */
    public function getPluginModel()
    {
        return $this->getModel(PluginModel::class);
    }

    /**
     * @return RoleModel
     */
    public function getRoleModel()
    {
        return $this->getModel(RoleModel::class);
    }

    /**
     * @return SchemeModel
     */
    public function getSchemeModel()
    {
        return $this->getModel(SchemeModel::class);
    }
}
