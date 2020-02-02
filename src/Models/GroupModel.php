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

use Psr\Http\Message\ResponseInterface;

/**
 * Class GroupModel
 *
 * @package Gnello\Mattermost\Models
 */
class GroupModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/groups';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getGroups(array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $groupId
     * @return ResponseInterface
     */
    public function getGroup($groupId)
    {
        return $this->client->get(self::$endpoint . '/' . $groupId);
    }

    /**
     * @param       $groupId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function patchGroup($groupId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $groupId, $requestOptions);
    }

    /**
     * @param $groupId
     * @param $teamId
     * @return ResponseInterface
     */
    public function linkTeamToGroup($groupId, $teamId)
    {
        return $this->client->post(self::$endpoint . '/' . $groupId . TeamModel::$endpoint . '/' . $teamId . '/link');
    }

    /**
     * @param $groupId
     * @param $teamId
     * @return ResponseInterface
     */
    public function deleteLinkTeamToGroup($groupId, $teamId)
    {
        return $this->client->delete(self::$endpoint . '/' . $groupId . TeamModel::$endpoint . '/' . $teamId . '/link');
    }

    /**
     * @param $groupId
     * @param $channelId
     * @return ResponseInterface
     */
    public function linkChannelToGroup($groupId, $channelId)
    {
        return $this->client->post(self::$endpoint . '/' . $groupId . ChannelModel::$endpoint . '/' . $channelId . '/link');
    }

    /**
     * @param $groupId
     * @param $channelId
     * @return ResponseInterface
     */
    public function deleteLinkChannelToGroup($groupId, $channelId)
    {
        return $this->client->delete(self::$endpoint . '/' . $groupId . ChannelModel::$endpoint . '/' . $channelId . '/link');
    }

    /**
     * @param $groupId
     * @param $teamId
     * @return ResponseInterface
     */
    public function getGroupSyncableFromTeamId($groupId, $teamId)
    {
        return $this->client->get(self::$endpoint . '/' . $groupId . TeamModel::$endpoint . '/' . $teamId);
    }

    /**
     * @param $groupId
     * @param $channelId
     * @return ResponseInterface
     */
    public function getGroupSyncableFromChannelId($groupId, $channelId)
    {
        return $this->client->get(self::$endpoint . '/' . $groupId . ChannelModel::$endpoint . '/' . $channelId);
    }

    /**
     * @param $groupId
     * @return ResponseInterface
     */
    public function getGroupTeams($groupId)
    {
        return $this->client->get(self::$endpoint . '/' . $groupId . TeamModel::$endpoint);
    }

    /**
     * @param $groupId
     * @return ResponseInterface
     */
    public function getGroupChannels($groupId)
    {
        return $this->client->get(self::$endpoint . '/' . $groupId . ChannelModel::$endpoint);
    }

    /**
     * @param $groupId
     * @param $teamId
     * @return ResponseInterface
     */
    public function patchGroupSyncableAssociateToTeam($groupId, $teamId)
    {
        return $this->client->put(self::$endpoint . '/' . $groupId . TeamModel::$endpoint . '/' . $teamId . '/patch');
    }

    /**
     * @param $groupId
     * @param $channelId
     * @return ResponseInterface
     */
    public function patchGroupSyncableAssociateToChannel($groupId, $channelId)
    {
        return $this->client->put(self::$endpoint . '/' . $groupId . ChannelModel::$endpoint . '/' . $channelId . '/patch');
    }

    /**
     * @param $groupId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getGroupUsers($groupId, array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint . '/' . $groupId . '/members', $requestOptions);
    }

    /**
     * @param $channelId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getChannelGroups($channelId, array $requestOptions = [])
    {
        return $this->client->get(ChannelModel::$endpoint . '/' . $channelId . '/groups', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeamGroups($teamId, array $requestOptions = [])
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . '/groups', $requestOptions);
    }


}
