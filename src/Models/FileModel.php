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

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

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
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function uploadFile(array $requestOptions)
    {
        $requestOptions = [
            [
                'name' => 'channel_id',
                'contents' => empty($requestOptions['channel_id']) ? null : $requestOptions['channel_id'],
            ],
            [
                'name' => 'files',
                'filename' => empty($requestOptions['filename']) ? null : $requestOptions['filename'],
                'contents' => empty($requestOptions['files']) ? null : $requestOptions['files'],
            ],
            [
                'name' => 'client_ids',
                'contents' => empty($requestOptions['client_ids']) ? null : $requestOptions['client_ids'],
            ],
        ];

        return $this->client->post(self::$endpoint, $requestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $fileId
     * @return ResponseInterface
     */
    public function getFile($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId);
    }

    /**
     * @param $fileId
     * @return ResponseInterface
     */
    public function getFilesThumbnail($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/thumbnail');
    }

    /**
     * @param $fileId
     * @return ResponseInterface
     */
    public function getFilesPreview($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/preview');
    }

    /**
     * @param $fileId
     * @return ResponseInterface
     */
    public function getPublicFileLink($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/link');
    }

    /**
     * @param $fileId
     * @return ResponseInterface
     */
    public function getMetadataForFile($fileId)
    {
        return $this->client->get(self::$endpoint . '/' . $fileId . '/info');
    }

}