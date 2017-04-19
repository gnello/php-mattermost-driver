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
 * Class UserEntity
 *
 * @package Gnello\MattermostRestApi\Entities
 */
class UserModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/users';

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createUser(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/create', $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAuthenticatedUser()
    {
        return $this->client->get(self::$endpoint . '/me');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function loginToUserAccount(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/login', $requestOptions);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function logoutOfUserAccount()
    {
        return $this->client->post(self::$endpoint . '/logout');
    }

    /**
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUsersList($offset, $limit)
    {
        $uri = self::$endpoint . '/' . $offset . '/' . $limit;
        return $this->client->get($uri);
    }

    /**
     * @param $team_id
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUsersListOfTeam($team_id, $offset, $limit)
    {
        $uri = '/teams/' . $team_id . '/' . self::$endpoint . '/' . $offset . '/' . $limit;
        return $this->client->get($uri);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchUsers(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param $username
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserByUsername($username)
    {
        return $this->client->get(self::$endpoint . '/name/' . $username);
    }

    /**
     * @param $email
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserByEmail($email)
    {
        return $this->client->get(self::$endpoint . '/email/' . $email);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUsersListByIds(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/ids/', $requestOptions);
    }

    /**
     * @param $team_id
     * @param $channel_id
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserOfChannel($team_id, $channel_id, $offset, $limit)
    {
        $uri = '/teams/' . $team_id . '/channels/' . $channel_id . '/' . self::$endpoint . '/' . $offset . '/' . $limit;
        return $this->client->get($uri);
    }

    /**
     * @param $team_id
     * @param $channel_id
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserNotOfChannel($team_id, $channel_id, $offset, $limit)
    {
        $uri = '/teams/' . $team_id . '/channels/' . $channel_id . '/' . self::$endpoint . '/not_in_channel/' . $offset . '/' . $limit;
        return $this->client->post($uri);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUser(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/update', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserRoles(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/update_roles', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserActive(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/update_active', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserNotificationProperties(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/update_notify', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserPassword(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/newpassword', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendPasswordResetEmail(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/send_password_reset', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function restUserPassword(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/reset_password', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function autocompleteUsers(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/autocomplete', $requestOptions);
    }

    /**
     * @param $team_id
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function autocompleteUsersOfTeam($team_id, array $requestOptions)
    {
        $uri = '/teams/' . $team_id . '/' . self::$endpoint . '/autocomplete';
        return $this->client->get($uri, $requestOptions);
    }

    /**
     * @param $team_id
     * @param $channel_id
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function autocompleteUsersOfChannel($team_id, $channel_id, array $requestOptions)
    {
        $uri = '/teams/' . $team_id . '/channels/' . $channel_id . '/' . self::$endpoint . '/autocomplete';
        return $this->client->get($uri, $requestOptions);
    }
}