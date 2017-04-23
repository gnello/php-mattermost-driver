<?php
/**
 * This Driver is based entirely on official documentation of the Mattermost Web
 * Services API and you can extend it by following the directives of the documentation.
 *
 * For the full copyright and license information, please read the LICENSE.txt
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/gnello/php-mattermost-driver/contributors
 *
 * God bless this mess.
 *
 * @author Luca Agnello <luca@gnello.com>
 * @link https://api.mattermost.com/
 */

namespace Gnello\Mattermost\Models;

use Gnello\Mattermost\Client;

/**
 * Class ChannelModel
 *
 * @package Gnello\Mattermost\Models
 */
class ChannelModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/channels';

    /**
     * @var string
     */
    private $teamId;

    /**
     * ChannelModel constructor.
     *
     * @param Client $client
     * @param        $teamID
     */
    public function __construct(Client $client, $teamID)
    {
        $this->teamId = $teamID;
        parent::__construct($client);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createChannel(array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/create', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateChannel(array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/update', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function viewChannel(array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/view', $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelsForTheUser()
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/');
    }

    /**
     * @param $channelName
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelByName($channelName)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/name/' . $channelName);
    }

    /**
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPageOfChannelsTheUserHasNotJoined($offset, $limit)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/more/' . $offset . '/' . $limit);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelMembersForTheUser()
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/members');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelsPinnedPosts()
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/pinned');
    }

    /**
     * @param $channelId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannel($channelId)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId);
    }

    /**
     * @param $channelId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getStatsOfChannel($channelId)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId . '/stats');
    }

    /**
     * @param $channelId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteChannel($channelId)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId . '/delete');
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUser($channelId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId . '/add', $requestOptions);
    }

    /**
     * @param $channelId
     * @param $userId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelMember($channelId, $userId)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId . '/members/' . $userId);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChannelMembersByIds($channelId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId . '/members/ids', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateRolesOfChannelMember($channelId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/' . $channelId . '/update_member_roles', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function autocompleteChannelsInATeam(array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/autocomplete', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchForMoreChannels(array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/more/search', $requestOptions);
    }
}