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
 * Class IntegrationActionsModel
 *
 * @package Gnello\Mattermost\Models
 */
class IntegrationActionsModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/actions';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function openDialog(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/dialogs/open', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function submitDialog(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/dialogs/submit', $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function deleteCurrentBrandImage()
    {
        return $this->client->delete(self::$endpoint . '/image');
    }
}
