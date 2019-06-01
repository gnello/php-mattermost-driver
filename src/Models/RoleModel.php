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

use Psr\Http\Message\ResponseInterface;

/**
 * Class RoleModel
 *
 * @package Gnello\Mattermost\Models
 */
class RoleModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/roles';

    /**
     * @param $roleId
     * @return ResponseInterface
     */
    public function getRoleByRoleId($roleId)
    {
        return $this->client->get(self::$endpoint . '/' . $roleId);
    }

    /**
     * @param $roleName
     * @return ResponseInterface
     */
    public function getRoleByRoleName($roleName)
    {
        return $this->client->get(self::$endpoint . '/name/' . $roleName);
    }

    /**
     * @param       $roleId
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function patchRole($roleId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/roles/' . $roleId . '/patch', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getRolesListByName(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/names', $requestOptions);
    }
}
