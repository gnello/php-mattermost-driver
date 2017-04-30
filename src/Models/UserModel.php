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
    public static $endpoint = '/users';

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
    public function createUser(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUsers(array $requestOptions)
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUsersByIds(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/ids', $requestOptions);
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
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function autocompleteUsers(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/autocomplete', $requestOptions);
    }

    /**
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUser($user_id)
    {
        return $this->client->get(self::$endpoint . '/' . $user_id);
    }

    /**
     * @param $user_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUser($user_id, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $user_id, $requestOptions);
    }

    /**
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deactivateUserAccount($user_id)
    {
        return $this->client->delete(self::$endpoint . '/' . $user_id);
    }

    /**
     * @param $user_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patchUser($user_id, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $user_id . '/patch', $requestOptions);
    }

    /**
     * @param $user_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserRoles($user_id, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $user_id . '/roles', $requestOptions);
    }

    /**
     * @param $user_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserActive($user_id, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $user_id . '/active', $requestOptions);
    }

    /**
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserProfileImage($user_id)
    {
        return $this->client->get(self::$endpoint . '/' . $user_id . '/image');
    }

    /**
     * @param $user_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function setUserProfileImage($user_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $user_id . '/image', $requestOptions, 'multipart');
    }

    /**
     * @param $username
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserByUsername($username)
    {
        return $this->client->get(self::$endpoint . '/username/' . $username);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function resetPassword(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/password/reset', $requestOptions);
    }
    
    /**
     * @param $user_id
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserMfa($user_id, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $user_id . '/mfa', $requestOptions);
    }

    /**
     * @param $user_id
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generateMfaSecret($user_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $user_id . '/mfa/generate', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkMfa(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/mfa', $requestOptions);
    }

    /**
     * @param $user_id
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUserPassword($user_id, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $user_id . '/password', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendPasswordResetEmail(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/password/reset/send', $requestOptions);
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
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserSessions($user_id)
    {
        return $this->client->get(self::$endpoint . '/' . $user_id . '/sessions');
    }

    /**
     * @param $user_id
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function revokeUserSession($user_id, array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/' . $user_id . '/sessions/revoke', $requestOptions);
    }

    /**
     * @param $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function attachMobileDevice(array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/sessions/device', $requestOptions);
    }

    /**
     * @param $user_id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserAudits($user_id)
    {
        return $this->client->get(self::$endpoint . '/' . $user_id . '/audits');
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function verifyUserEmail(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/email/verify', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendVerificationEmail(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/email/verify/send', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function switchLoginMethod(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/login/switch', $requestOptions);
    }
}
