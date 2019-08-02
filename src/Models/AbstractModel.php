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
 * Class AbstractModel
 *
 * @package Gnello\Mattermost
 */
abstract class AbstractModel
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * AbstractModel constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Builds multipart data options.
     *
     * @param array $requestOptions The options to pass to the server.
     * @param array $requiredFields The required fields of the server.
     * @return array
     */
    protected static function buildMultipartDataOptions(array $requestOptions = [], array $requiredFields = [])
    {
        $multipartDataOptions = [];

        //required fields
        foreach ($requiredFields as $field) {
            $multipartDataOptions[] = [
                'name' => $field,
                'contents' => empty($requestOptions[$field]) ? null : $requestOptions[$field],
            ];

            unset($requestOptions[$field]);
        }

        //optional fields
        foreach ($requestOptions as $field => $value) {
            $multipartDataOptions[] = [
                'name' => $field,
                'contents' => empty($value) ? null : $value,
            ];
        }

        return $multipartDataOptions;
    }
}