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
 * Class BotModel
 *
 * @package Gnello\Mattermost\Models
 */
class BotModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/bots';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function createBot(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getBots(array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param       $botUserId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function patchBot($botUserId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/' . $botUserId, $requestOptions);
    }

    /**
     * @param       $botUserId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getBot($botUserId, array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint . '/' . $botUserId, $requestOptions);
    }

    /**
     * @param $botUserId
     * @return ResponseInterface
     */
    public function disableBot($botUserId)
    {
        return $this->client->post(self::$endpoint . '/' . $botUserId . '/disable');
    }

    /**
     * @param $botUserId
     * @return ResponseInterface
     */
    public function enableBot($botUserId)
    {
        return $this->client->post(self::$endpoint . '/' . $botUserId . '/enable');
    }

    /**
     * @param $botUserId
     * @param $userId
     * @return ResponseInterface
     */
    public function assignBotToUser($botUserId, $userId)
    {
        return $this->client->post(self::$endpoint . '/' . $botUserId . '/assign/' . $userId);
    }

    /**
     * @param $botUserId
     * @return ResponseInterface
     */
    public function getBotIcon($botUserId)
    {
        return $this->client->get(self::$endpoint . '/' . $botUserId . '/icon');
    }

    /**
     * @param $botUserId
     * @return ResponseInterface
     */
    public function setBotIcon($botUserId, array $requestOptions)
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['image']);

        return $this->client->post(self::$endpoint . '/' . $botUserId . '/icon', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $botUserId
     * @return ResponseInterface
     */
    public function deleteBotIcon($botUserId)
    {
        return $this->client->delete(self::$endpoint . '/' . $botUserId . '/icon');
    }
}
