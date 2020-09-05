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

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

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
     * @return ResponseInterface
     */
    public function createTeam(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeams(array $requestOptions)
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $teamId
     * @return ResponseInterface
     */
    public function getTeam($teamId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateTeam($teamId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId, $requestOptions);
    }

    /**
     * @param $teamId
     * @return ResponseInterface
     */
    public function deleteTeam($teamId)
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function patchTeam($teamId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/patch', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateTeamPrivacy($teamId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/privacy', $requestOptions);
    }

    /**
     * @param $teamId
     * @return ResponseInterface
     */
    public function restoreTeam($teamId)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/restore');
    }

    /**
     * @param $teamName
     * @return ResponseInterface
     */
    public function getTeamByName($teamName)
    {
        return $this->client->get(self::$endpoint . '/name/' . $teamName);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function searchTeams(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param $teamName
     * @return ResponseInterface
     */
    public function checkTeamExists($teamName)
    {
        return $this->client->get(self::$endpoint . '/name/' . $teamName . '/exists');
    }

    /**
     * @param $userId
     * @return ResponseInterface
     */
    public function getUserTeams($userId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams');
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeamMembers($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function addUser($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function addUserFromInvite(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/members/invite', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function addMultipleUsers($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members/batch', $requestOptions);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeamMembersForUser($userId, array $requestOptions)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param $userId
     * @return ResponseInterface
     */
    public function getTeamMember($teamId, $userId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members/' . $userId);
    }

    /**
     * @param       $teamId
     * @param       $userId
     * @return ResponseInterface
     */
    public function removeUser($teamId, $userId)
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId . '/members/' . $userId);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeamMembersByIds($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members/ids', $requestOptions);
    }

    /**
     * @param $teamId
     * @return ResponseInterface
     */
    public function getTeamStats($teamId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/stats');
    }

    /**
     * @param       $teamId
     * @return ResponseInterface
     */
    public function regenerateInviteID($teamId)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/regenerate_invite_id');
    }

    /**
     * @param $teamId
     * @return ResponseInterface
     */
    public function getTeamIcon($teamId)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/image');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function setTeamIcon($teamId, array $requestOptions)
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['image']);

        return $this->client->post(self::$endpoint . '/' . $teamId . '/image', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $teamId
     * @return ResponseInterface
     */
    public function removeTeamIcon($teamId)
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId . '/image');
    }

    /**
     * @param $teamId
     * @param $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateTeamMemberRoles($teamId, $userId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/members/' . $userId . '/roles', $requestOptions);
    }

    /**
     * @param $teamId
     * @param $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function updateSchemeDerivedRolesOfMember($teamId, $userId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/members/' . $userId . '/schemeRoles', $requestOptions);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getUserTotalUnreadMessagesFromTeams($userId,  array $requestOptions = [])
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/unread', $requestOptions);
    }

    /**
     * @param $userId
     * @param $teamId
     * @return ResponseInterface
     */
    public function getUserTotalUnreadMessagesFromTeam($userId, $teamId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/' . $teamId . '/unread');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function inviteUsersByEmail($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/invite/email', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function inviteGuestsByEmail($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/invite-guests/email', $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function invalidateActiveEmailInvitations()
    {
        return $this->client->delete(self::$endpoint . '/invites/email');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function importTeamFromOtherApplication($teamId, array $requestOptions)
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['file', 'filesize', 'importFrom']);

        return $this->client->post(self::$endpoint . '/' . $teamId . '/import', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $inviteId
     * @return ResponseInterface
     */
    public function getInviteInfoForTeam($inviteId)
    {
        return $this->client->get(self::$endpoint . '/invite/' . $inviteId);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function setTeamScheme($teamId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/scheme', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeamMembersMinusGroupMembers($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members_minus_group_members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getPublicChannels($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/channels', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getDeletedChannels($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/channels/deleted', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function searchChannels($teamId, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/channels/search', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function listCommandsAutocompleteData($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/commands/autocomplete_suggestions',
            $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getTeamGroupsByChannels($teamId, array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/groups_by_channels', $requestOptions);
    }
}
