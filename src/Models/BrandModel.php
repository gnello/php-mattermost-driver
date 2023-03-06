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

use Gnello\Mattermost\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BrandModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class BrandModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/brand';

    /**
     * @return ResponseInterface
     */
    public function getBrandImage()
    {
        return $this->client->get(self::$endpoint . '/image');
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function uploadBrandImage(array $requestOptions)
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['image']);

        return $this->client->post(self::$endpoint . '/image', $internalRequestOptions, Client::REQUEST_MULTIPART);
    }

    /**
     * @return ResponseInterface
     */
    public function deleteCurrentBrandImage()
    {
        return $this->client->delete(self::$endpoint . '/image');
    }
}
