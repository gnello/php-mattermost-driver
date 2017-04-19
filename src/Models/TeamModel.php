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
     * @param $team_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getGetTeamMembers($team_id)
    {
        return $this->client->get(self::$endpoint . '/members/' . $team_id);
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
     * @param       $team_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateTeam($team_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/teams/' . $team_id . '/update', $requestOptions);
    }

    /**
     * @param $team_id
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUser($team_id, $user_id)
    {
        return $this->client->post(self::$endpoint . '/teams/' . $team_id . '/add_user_to_team', compact('user_id'));
    }

    /**
     * @param $team_id
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removeUser($team_id, $user_id)
    {
        return $this->client->post(self::$endpoint . '/teams/' . $team_id . '/remove_user_from_team', compact('user_id'));
    }
}