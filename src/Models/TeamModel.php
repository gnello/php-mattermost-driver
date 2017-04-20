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
        return $this->client->post(self::$endpoint . '/create', $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAllTeams()
    {
        return $this->client->get(self::$endpoint . '/all');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAllTeamsUserIsMemberOf()
    {
        return $this->client->get(self::$endpoint . '/members');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCountUnreadMessagesAndMentionsInTeamsUserIsMemberOf()
    {
        return $this->client->get(self::$endpoint . '/unread');
    }

    /**
     * @param $team_id
     * @param $offset
     * @param $limit
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getTeamMembers($team_id, $offset, $limit)
    {
        return $this->client->get(self::$endpoint . '/' . $team_id . '/members/' . $offset . '/' . $limit);
    }

    /**
     * @param $team_id
     * @param $userId
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getSingleTeamMember($team_id, $userId)
    {
        return $this->client->get(self::$endpoint . '/' . $team_id . '/members/' . $userId);
    }

    /**
     * @param       $team_id
     * @param array $requestOptions
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getTeamMembersByIds($team_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $team_id . '/members/ids', $requestOptions);
    }

    /**
     * @param $team_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTeam($team_id)
    {
        return $this->client->get(self::$endpoint . '/' . $team_id . '/me');
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
     * @param       $team_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateTeam($team_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $team_id . '/update', $requestOptions);
    }

    /**
     * @param       $team_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getStatsOfTeam($team_id)
    {
        return $this->client->get(self::$endpoint . '/' . $team_id . '/stats');
    }

    /**
     * @param $team_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUser($team_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $team_id . '/add_user_to_team', $requestOptions);
    }

    /**
     * @param       $team_id
     * @param array $requestOptions
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function removeUser($team_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $team_id . '/remove_user_from_team', $requestOptions);
    }

    /**
     * @param       $team_id
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getAllSlashCommandsOfTeam($team_id)
    {
        return $this->client->get(self::$endpoint . '/' . $team_id . '/commands/list_team_commands');
    }
}