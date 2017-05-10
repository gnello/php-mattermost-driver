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

/**
 * Class WebhookModel
 *
 * @package Gnello\MattermostRestApi\Models
 */
class WebhookModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/hooks';

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createIncomingWebhook(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/incoming', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listIncomingWebhooks(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/incoming', $requestOptions);
    }

    /**
     * @param       $hookId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getIncomingWebhook($hookId)
    {
        return $this->client->get(self::$endpoint . '/incoming/' . $hookId);
    }

    /**
     * @param       $hookId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateIncomingWebhook($hookId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/incoming/' . $hookId, $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createOutgoingWebhook(array $requestOptions)
    {
        return $this->client->post(self::$endpoint . '/outgoing', $requestOptions);
    }

    /**
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listOutgoingWebhooks(array $requestOptions)
    {
        return $this->client->get(self::$endpoint . '/outgoing', $requestOptions);
    }

    /**
     * @param       $hookId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getOutgoingWebhook($hookId)
    {
        return $this->client->get(self::$endpoint . '/outgoing/' . $hookId);
    }

    /**
     * @param       $hookId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteOutgoingWebhook($hookId)
    {
        return $this->client->delete(self::$endpoint . '/outgoing/' . $hookId);
    }

    /**
     * @param       $hookId
     * @param array $requestOptions
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOutgoingWebhook($hookId, array $requestOptions)
    {
        return $this->client->put(self::$endpoint . '/outgoing/' . $hookId, $requestOptions);
    }

    /**
     * @param       $hookId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function regenerateTokenForOutgoingWebhook($hookId)
    {
        return $this->client->post(self::$endpoint . '/outgoing/' . $hookId . '/regen_token');
    }
}
