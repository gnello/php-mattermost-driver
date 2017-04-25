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
 * Class FileModel
 *
 * @package Gnello\Mattermost\Models
 */
class FileModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/files';

    /**
     * @param       $teamId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadFile($teamId, array $requestOptions)
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . '/' . self::$endpoint . '/upload', $requestOptions);
    }

    /**
     * @param $fileId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getFile($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/get');
    }

    /**
     * @param $fileId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getImageThumbnail($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/get_thumbnail');
    }

    /**
     * @param $fileId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getImagePreview($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/get_preview');
    }

    /**
     * @param $fileId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getMetadataForFile($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/get_info');
    }

    /**
     * @param $fileId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPublicFileLink($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/get_public_link');
    }

}