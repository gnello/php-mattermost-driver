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

use Gnello\Mattermost\Models\BotModel;
use Gnello\Mattermost\Models\BrandModel;
use Gnello\Mattermost\Models\ChannelModel;
use Gnello\Mattermost\Models\ClusterModel;
use Gnello\Mattermost\Models\CommandModel;
use Gnello\Mattermost\Models\ComplianceModel;
use Gnello\Mattermost\Models\DataRetentionModel;
use Gnello\Mattermost\Models\ElasticsearchModel;
use Gnello\Mattermost\Models\EmojiModel;
use Gnello\Mattermost\Models\FileModel;
use Gnello\Mattermost\Models\GroupModel;
use Gnello\Mattermost\Models\IntegrationActionsModel;
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
use Gnello\Mattermost\Models\ThreadModel;
use Gnello\Mattermost\Models\UserModel;
use Gnello\Mattermost\Models\WebhookModel;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

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
    private const DEFAULT_OPTIONS = [
        'scheme' => 'https',
        'basePath' => '/api/v4',
        'url' => 'localhost',
        'login_id' => null,
        'password' => null,
        'token' => null,
    ];

    /** @var array<string, ?string> */
    private $driverOptions;

    /** @var Client */
    private $client;

    /**
     * @var array
     */
    private $models = [];

    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        array $driverOptions
    ) {
        $this->driverOptions = array_merge(self::DEFAULT_OPTIONS, $driverOptions);
        $this->client = new Client(
            $httpClient,
            $requestFactory,
            $streamFactory,
            $this->driverOptions['scheme'] . '://' . $this->driverOptions['url'] . $this->driverOptions['basePath']
        );
    }

    /**
     * @return ResponseInterface
     */
    public function authenticate()
    {
        if (isset($this->driverOptions['token'])) {
            $this->client->setToken($this->driverOptions['token']);
            $response = $this->getUserModel()->getAuthenticatedUser();
        } else if (isset($this->driverOptions['login_id']) && isset($this->driverOptions['password'])) {
            $response = $this->getUserModel()->loginToUserAccount([
                'login_id' => $this->driverOptions['login_id'],
                'password' => $this->driverOptions['password']
            ]);

            if ($response->getStatusCode() == 200) {
                $token = $response->getHeader('Token')[0];
                $this->client->setToken($token);
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
            $this->models[$className] = new $className($this->client);
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
        $preferenceModel = $this->getModel(PreferenceModel::class);

        // see https://github.com/gnello/php-mattermost-driver/issues/32
        return $preferenceModel->setUserId($userId);
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

    /**
     * @return BotModel
     */
    public function getBotModel()
    {
        return $this->getModel(BotModel::class);
    }

    /**
     * @return GroupModel
     */
    public function getGroupModel()
    {
        return $this->getModel(GroupModel::class);
    }

    /**
     * @return IntegrationActionsModel
     */
    public function getIntegrationActionsModel()
    {
        return $this->getModel(IntegrationActionsModel::class);
    }

    /**
     * @return ThreadModel
     */
    public function getThreadModel()
    {
        return $this->getModel(ThreadModel::class);
    }
}
