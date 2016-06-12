<?php
/**
 * Gamblingtec OAuth 2.0 Client Provider for The PHP League OAuth2-Client
 *
 * @copyright Copyright (c) 2014-2016 SunSeven NV (http://www.sunseven-nv.com)
 * @license   BSD 3-Clause
 */

namespace Gamblingtec\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class GamblingtecResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['uuid'] ?: null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
