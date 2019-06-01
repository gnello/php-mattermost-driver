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
 * @author Bruno Spyckerelle <bruno@spyckerelle.fr>
 * @link https://api.mattermost.com/
 */

namespace Gnello\Mattermost\Models;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ReactionModel
 *
 * @package Gnello\Mattermost\Models
 */
class ReactionModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/reactions';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function saveReaction(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }
}
