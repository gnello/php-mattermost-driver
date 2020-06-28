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

use Psr\Http\Message\ResponseInterface;

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
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function createChannel(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function createDirectMessageChannel(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/direct', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function createGroupMessageChannel(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/group', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getChannelsListByIds($teamId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/ids', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getChannelsList(array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $channelId
     * @return ResponseInterface
     */
    public function getChannel($channelId)
    {
        return $this->client->get(self::$endpoint . '/' . $channelId);
    }

    /**
     * @param $channelId
     * @return ResponseInterface
     */
    public function getTimezone($channelId)
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/timezones');
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateChannel($channelId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $channelId, $requestOptions);
    }

    /**
     * @param $channelId
     * @return ResponseInterface
     */
    public function deleteChannel($channelId)
    {
        return $this->client->delete(self::$endpoint . '/' . $channelId);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function patchChannel($channelId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/patch', $requestOptions);
    }

    /**
     * @param       $channelId
     * @return ResponseInterface
     */
    public function restoreChannel($channelId)
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/restore');
    }

    /**
     * @param $channelId
     * @return ResponseInterface
     */
    public function getChannelStatistics($channelId)
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/stats');
    }

    /**
     * @param $channelId
     * @return ResponseInterface
     */
    public function getChannelsPinnedPosts($channelId)
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/pinned');
    }

    /**
     * @param $teamId
     * @param $channelName
     * @return ResponseInterface
     */
    public function getChannelByName($teamId, $channelName)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/name/' . $channelName);
    }

    /**
     * @param $teamName
     * @param $channelName
     * @return ResponseInterface
     */
    public function getChannelByNameAndTeamName($teamName, $channelName)
    {
        return $this->client->get(TeamModel::$endpoint . '/name/' . $teamName . self::$endpoint . '/name/' . $channelName);
    }

    /**
     * @param $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getChannelMembers($channelId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/members', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function addUser($channelId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/members', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getChannelMembersByIds($channelId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/members/ids', $requestOptions);
    }

    /**
     * @param $channelId
     * @param $userId
     * @return ResponseInterface
     */
    public function getChannelMember($channelId, $userId)
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/members/' . $userId);
    }

    /**
     * @param $channelId
     * @param $userId
     * @return ResponseInterface
     */
    public function removeUserFromChannel($channelId, $userId)
    {
        return $this->client->delete(self::$endpoint . '/' . $channelId . '/members/' . $userId);
    }

    /**
     * @param       $channelId
     * @param       $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateChannelRoles($channelId, $userId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/members/' . $userId . '/roles', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param       $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateChannelNotifications($channelId, $userId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/members/' . $userId . '/notify_props', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function viewChannel($userId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/members/' . $userId . '/view', $requestOptions);
    }

    /**
     * @param $userId
     * @param $teamId
     * @return ResponseInterface
     */
    public function getChannelMembersForTheUser($userId, $teamId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/members');
    }

    /**
     * @param $userId
     * @param $teamId
     * @return ResponseInterface
     */
    public function getChannelsForUser($userId, $teamId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId . self::$endpoint);
    }

    /**
     * @param $userId
     * @param $channelId
     * @return ResponseInterface
     */
    public function getUnreadMessages($userId, $channelId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . self::$endpoint . '/' . $channelId . '/unread');
    }

    /**
     * @param $channelId
     * @return ResponseInterface
     */
    public function convertChannelFromPublicToPrivate($channelId)
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/convert');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getPublicChannels($teamId, array $requestOptions)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint, $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getDeletedChannels($teamId, array $requestOptions)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/deleted', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function autocompleteChannels($teamId, array $requestOptions)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/autocomplete', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function autocompleteChannelsForSearch($teamId, array $requestOptions)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/search_autocomplete', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function searchChannels($teamId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function searchArchivedChannels($teamId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/search_archived', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function searchAllPrivateAndOpenTypeChannels(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function searchGroupChannels(array $requestOptions)
    {
        return $this->client->post('/group/search', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getMembersMinusGroupMembers($channelId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . $channelId . '/members_minus_group_members', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateChannelPrivacy($channelId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/privacy', $requestOptions);
    }
}
