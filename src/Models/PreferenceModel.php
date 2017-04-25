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
 * Class PreferenceModel
 *
 * @package Gnello\Mattermost\Models
 */
class PreferenceModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/preferences';

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function saveUserPreferences(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/save', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteUserPreferences(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/delete', $requestOptions);
    }

    /**
     * @param $category
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listUserPreferences($category)
    {
        return $this->client->get(self::$endpoint . '/' . $category);
    }

    /**
     * @param $category
     * @param $name
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSpecificUserPreference($category, $name)
    {
        return $this->client->get(self::$endpoint . '/' . $category . '/' . $name);
    }

}