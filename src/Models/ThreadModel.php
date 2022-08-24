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
 * Class ThreadsModel
 *
 * @package Gnello\Mattermost
 */
class ThreadModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/threads';

    /**
     * @param       $userId
     * @param       $teamId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getThreadsThatUserIsFollowing($userId, $teamId, array $requestOptions)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId
            . '/' . self::$endpoint , $requestOptions);
    }

    /**
     * @param $userId
     * @param $teamId
     * @return ResponseInterface
     */
    public function getUnreadMentionCounts($userId, $teamId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId
            . '/' . self::$endpoint . '/mention_counts');
    }

    /**
     * @param $userId
     * @param $teamId
     * @return ResponseInterface
     */
    public function markThreadsAsRead($userId, $teamId)
    {
        return $this->client->put(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId
            . '/' . self::$endpoint . '/read');
    }

    /**
     * @param $userId
     * @param $teamId
     * @param $threadId
     * @param $timestamp
     * @return ResponseInterface
     */
    public function markThreadToTimestamp($userId, $teamId, $threadId, $timestamp)
    {
        return $this->client->put(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId
            . '/' . self::$endpoint . '/' . $threadId . '/read/' . $timestamp);
    }

    /**
     * @param $userId
     * @param $teamId
     * @param $threadId
     * @return ResponseInterface
     */
    public function startFollowingThread($userId, $teamId, $threadId)
    {
        return $this->client->put(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId
            . '/' . self::$endpoint . '/' . $threadId . '/following');
    }

    /**
     * @param $userId
     * @param $teamId
     * @param $threadId
     * @return ResponseInterface
     */
    public function stopFollowingThread($userId, $teamId, $threadId)
    {
        return $this->client->delete(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/'
            . $teamId . '/' . self::$endpoint . '/' . $threadId . '/following');
    }

    /**
     * @param $userId
     * @param $teamId
     * @param $threadId
     * @return ResponseInterface
     */
    public function getThreadFollowedByUser($userId, $teamId, $threadId)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId
            . '/' . self::$endpoint . '/' . $threadId);
    }
}