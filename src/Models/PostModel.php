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

/**
 * Class PostModel
 *
 * @package Gnello\Mattermost\Models
 */
class PostModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/posts';

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createPost(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPost($postId)
    {
        return $this->client->get(self::$endpoint . '/' . $postId);
    }

    /**
     * @param $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deletePost($postId)
    {
        return $this->client->delete(self::$endpoint . '/' . $postId);
    }

    /**
     * @param       $postId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updatePost($postId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $postId, $requestOptions);
    }

    /**
     * @param       $postId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patchPost($postId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $postId . '/patch', $requestOptions);
    }

    /**
     * @param $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getThread($postId)
    {
        return $this->client->get(self::$endpoint . '/' . $postId . '/thread');
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getFlaggedPosts($userId, array $requestOptions)
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/posts/flagged', $requestOptions);
    }

    /**
     * @param       $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getFileInfoForPost($postId)
    {
        return $this->client->get(self::$endpoint . '/' . $postId . '/files/info');
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPostsForChannel($channelId, array $requestOptions)
    {
        return $this->client->get(ChannelModel::$endpoint . '/' . $channelId . '/posts', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchForTeamPosts($teamId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . '/posts/search', $requestOptions);
    }

    /**
     * @param       $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function pinPost($postId)
    {
        return $this->client->post(self::$endpoint . '/' . $postId . '/pin');
    }

    /**
     * @param       $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function unpinPost($postId)
    {
        return $this->client->post(self::$endpoint . '/' . $postId . '/unpin');
    }

    /**
     * @param       $postId
     * @param       $actionId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function performPostAction($postId, $actionId)
    {
        return $this->client->post(self::$endpoint . '/' . $postId . '/actions/' . $actionId);
    }
}