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
     * @var string
     */
    private $teamId;

    /**
     * ChannelModel constructor.
     *
     * @param Client $client
     * @param        $teamID
     */
    public function __construct(Client $client, $teamID)
    {
        $this->teamId = $teamID;
        parent::__construct($client);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchForPosts(array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getFlaggedPosts($offset, $limit)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/flagged/' . $offset . '/' . $limit);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createPost($channelId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/create', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updatePost($channelId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/update', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param       $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function pinPost($channelId, $postId)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/pin');
    }

    /**
     * @param       $channelId
     * @param       $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function unpinPost($channelId, $postId)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/unpin');
    }

    /**
     * @param $channelId
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPostsForChannel($channelId, $offset, $limit)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/page/' . $offset . '/' . $limit);
    }

    /**
     * @param $channelId
     * @param $time
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPostsSinceTime($channelId, $time)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/since/' . $time);
    }

    /**
     * @param $channelId
     * @param $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPost($channelId, $postId)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/get');
    }

    /**
     * @param $channelId
     * @param $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deletePost($channelId, $postId)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/delete');
    }

    /**
     * @param $channelId
     * @param $postId
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPostsBeforePost($channelId, $postId, $offset, $limit)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/before/' . $offset . '/' . $limit);
    }

    /**
     * @param $channelId
     * @param $postId
     * @param $offset
     * @param $limit
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPostsAfterPost($channelId, $postId, $offset, $limit)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/after/' . $offset . '/' . $limit);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getOpenGraphMetadataForURL(array $requestOptions)
    {
        return $this->client->post('get_opengraph_metadata', $requestOptions);
    }

    /**
     * @param $channelId
     * @param $postId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listReactionsToPost($channelId, $postId)
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/reactions');
    }

    /**
     * @param       $channelId
     * @param       $postId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function reactToPost($channelId, $postId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/reactions/save', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param       $postId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removeReactionFromPost($channelId, $postId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $this->teamId . '/' . ChannelModel::$endpoint . '/' . $channelId . '/' . self::$endpoint . '/' . $postId . '/reactions/delete', $requestOptions);
    }
}