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
 * Class TeamModel
 *
 * @package Gnello\Mattermost
 */
class TeamModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/teams';

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createTeam(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeams(array $requestOptions)
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $teamId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeam($teamId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateTeam($teamId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId, $requestOptions);
    }

    /**
     * @param $teamId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteTeam($teamId)
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patchTeam($teamId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/patch', $requestOptions);
    }

    /**
     * @param $teamName
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamByName($teamName)
    {
        return $this->client->get(self::$endpoint . '/name/' . $teamName);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchTeams(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param $teamName
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkTeamExists($teamName)
    {
        return $this->client->get(self::$endpoint . '/name/' . $teamName . '/exists');
    }

    /**
     * @param $userId
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getUserTeams($userId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams');
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamMembers($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUser($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUserFromInvite(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/members/invite', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addMultipleUsers($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members/batch', $requestOptions);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamMembersForUser($userId, array $requestOptions)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param $userId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamMember($teamId, $userId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members/' . $userId);
    }

    /**
     * @param       $teamId
     * @param       $userId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removeUser($teamId, $userId, array $requestOptions)
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId . '/members/' . $userId, $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamMembersByIds($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members/ids', $requestOptions);
    }

    /**
     * @param $teamId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeamStats($teamId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/stats');
    }

    /**
     * @param $teamId
     * @param $userId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateTeamMemberRoles($teamId, $userId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members/' . $userId . '/roles', $requestOptions);
    }

    /**
     * @param $userId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserTotalUnreadMessagesFromTeams($userId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/unread');
    }

    /**
     * @param $userId
     * @param $teamId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserTotalUnreadMessagesFromTeam($userId, $teamId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/' . $teamId . '/unread');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function inviteUsersByEmail($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/invite/email', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function importTeamFromOtherApplication($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/import', $requestOptions, Client::TYPE_MULTIPART);
    }

    /**
     * @param $teamId
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getInviteInfoForTeam($teamId)
    {
        return $this->client->get(self::$endpoint . '/invite/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getPublicChannels($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/channels', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getDeletedChannels($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/channels/deleted', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchChannels($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/channels/search', $requestOptions);
    }
}
