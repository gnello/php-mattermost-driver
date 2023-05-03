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
 * Class JobModel
 *
 * @package Gnello\Mattermost\Models
 */
class JobModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/jobs';

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getJobs(array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint, $requestOptions, Client::REQUEST_QUERY);
    }

    /**
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function createJob(array $requestOptions)
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param $jobId
     * @return ResponseInterface
     */
    public function getJob($jobId)
    {
        return $this->client->get(self::$endpoint . '/' . $jobId);
    }

    /**
     * @param $jobId
     * @return ResponseInterface
     */
    public function deleteJob($jobId)
    {
        return $this->client->post(self::$endpoint . '/' . $jobId . '/cancel');
    }

    /**
     * @param       $type
     * @param array $requestOptions
     * @return ResponseInterface
     */
    public function getJobsOfType($type, array $requestOptions = [])
    {
        return $this->client->get(self::$endpoint . '/type/' . $type, $requestOptions);
    }
}
