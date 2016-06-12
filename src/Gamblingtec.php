<?php
/**
 * Gamblingtec OAuth 2.0 Client Provider for The PHP League OAuth2-Client
 *
 * @copyright Copyright (c) 2014-2016 SunSeven NV (http://www.sunseven-nv.com)
 * @license   BSD 3-Clause
 */

namespace Gamblingtec\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Gamblingtec extends AbstractProvider
{
    use BearerAuthorizationTrait;

    protected $domain = 'https://www.gamblingtec.com';

    public function __construct($options = [])
    {
        parent::__construct($options);

        if (isset($options['domain'])) {
            $this->domain = $options['domain'];
        }
    }

    protected function getDefaultHeaders()
    {
        return ['Accept' => 'application/json'];
    }

    public function getBaseAuthorizationUrl()
    {
        return $this->domain . '/oauth/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->domain . '/oauth';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->domain . '/api/user';
    }

    protected function getDefaultScopes()
    {
        return [];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException($response->getReasonPhrase(), $response->getStatusCode(), (string) $response->getBody());
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new GamblingtecResourceOwner($response);
    }
}
