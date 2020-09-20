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
use Psr\Http\Message\ResponseInterface;

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
     * @var string
     */
    private $userId;

    /**
     * PreferenceModel constructor.
     *
     * @param Client $client
     * @param        $userId
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * @param $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    private function getUserId()
    {
        if (is_null($this->userId)) {
            throw new \UnexpectedValueException("User id is not set.");
        }

        return $this->userId;
    }

    /**
     * @return ResponseInterface
     */
    public function getUserPreference()
    {
        $userId = $this->getUserId();

        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/preferences');
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function saveUserPreferences(array $requestOptions)
    {
        $userId = $this->getUserId();

        return $this->client->put(UserModel::$endpoint . '/' . $userId . '/preferences', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function deleteUserPreferences(array $requestOptions)
    {
        $userId = $this->getUserId();

        return $this->client->post(UserModel::$endpoint . '/' . $userId . '/preferences/delete', $requestOptions);
    }

    /**
     * @param $category
     * @return ResponseInterface
     */
    public function listUserPreferences($category)
    {
        $userId = $this->getUserId();

        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/preferences/' . $category);
    }

    /**
     * @param $category
     * @param $preferenceName
     * @return ResponseInterface
     */
    public function getSpecificUserPreference($category, $preferenceName)
    {
        $userId = $this->getUserId();

        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/preferences/' . $category . '/name/' . $preferenceName);
    }

}