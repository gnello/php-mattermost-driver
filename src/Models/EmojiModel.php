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

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class EmojiModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class EmojiModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/emoji';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function createCustomEmoji(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getListOfCustomEmoji(array $requestOptions)
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $emojiId
     * @return ResponseInterface
     */
    public function getCustomEmoji($emojiId)
    {
        return $this->client->get(self::$endpoint . '/' . $emojiId);
    }

    /**
     * @param $emojiId
     * @return ResponseInterface
     */
    public function deleteCustomEmoji($emojiId)
    {
        return $this->client->delete(self::$endpoint . '/' . $emojiId);
    }

    /**
     * @param $emojiId
     * @return ResponseInterface
     */
    public function getCustomEmojiImage($emojiId)
    {
        return $this->client->get(self::$endpoint . '/' . $emojiId . '/image');
    }

}
