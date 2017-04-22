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
 * Class ChannelModel
 *
 * @package Gnello\Mattermost\Models
 */
class ChannelModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/channels';

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createChannel($teamId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . '/' . self::$endpoint . '/create', $requestOptions);
    }
}