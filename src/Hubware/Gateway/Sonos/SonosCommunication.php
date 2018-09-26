<?php
/**
 * This file is part of the hubware/sonos library
 *
 * (C) hubware AG
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Hubware\Gateway\Sonos;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use kamermans\OAuth2\GrantType\ClientCredentials;
use kamermans\OAuth2\GrantType\NullGrantType;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\Persistence\FileTokenPersistence;

/**
 * Class SonosCommunication
 * @deprecated
 * @package Hubware\Gateway\Sonos
 */
class SonosCommunication
{
    const OAUTH_SCOPE_ALL = 'playback-control-all';
    const OAUTH_URL_ACCESS_REQUEST = 'https://api.sonos.com/login/v3/oauth/access';
    const API_BASE = 'https://api.ws.sonos.com/control/api/';
    const API_VERSION = 'v1';

    /**
     * @var string OAuth2 client id
     */
    private $clientId = null;

    /**
     * @var string OAuth2 client secret
     */
    private $clientSecret = null;

    /**
     * @var string user-specific client key
     */
    private $userKey = null;

    /**
     * @var string oauth2 access token
     */
    private $accessToken = null;

    /**
     * @var string oauth2 refresh token
     */
    private $refreshToken = null;

    /**
     * @var string OAuth2 scope
     */
    private $scope = self::OAUTH_SCOPE_ALL;

    /**
     * @var string uri for redirect of initial user login
     */
    private $redirectUriLogin = null;

    /**
     * @var FileTokenPersistence holds the okens
     */
    private $tokenStorage;

    /**
     * SonosManager constructor.
     *
     * @param null $clientId
     * @param null $clientSecret
     * @param      $redirectUriLogin
     */
    public function __construct($clientId, $clientSecret, $redirectUriLogin)
    {
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUriLogin = $redirectUriLogin;

        $this->tokenStorage = new FileTokenPersistence('/tmp/token.txt');
    }

    private function getOAuthClient()
    {
        // Authorization client - this is used to request OAuth access tokens
        $reauthClient = new Client([
            // URL for access_token request
            'base_uri' => self::OAUTH_URL_ACCESS_REQUEST,
        ]);
        $reauthConfig = [
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret,
            "scope" => $this->scope,
            "state" => time(),
            'redirect_uri' => $this->redirectUriLogin,
        ];
        $grantType = new ClientCredentials($reauthClient, $reauthConfig);
        $oauth = new OAuth2Middleware($grantType);
        return $oauth;
    }

    protected function getClient()
    {
        $oauth = $this->getOAuthClient();
        $stack = HandlerStack::create();
        $stack->push($oauth);

        $client = new Client([
            'handler' => $stack,
            'auth'    => 'oauth',
        ]);

        return $client;
    }


    protected function getResponse($url)
    {
        $client = $this->getClient();
        $url = self::API_BASE.self::API_VERSION.'/'.$url;
        $response = $client->get($url);

        // validate header - any error?

        return $response;
    }

    public function authenticate($userKey = null, $accessToken = null, $refreshToken = null)
    {
        if ($userKey != null)
        {
            $this->userKey = $userKey;
    //        return true;
        }
        if ($this->accessToken == null && $accessToken != null) {
            $this->accessToken = $accessToken;
        }

        if ($this->refreshToken == null && $refreshToken != null) {
            $this->refreshToken = $refreshToken;
        }

        global $_POST;
        if (isset($_REQUEST['cb']) && $_REQUEST['cb'] == 'auth' && isset($_REQUEST['code']))
        {
            // HANDLE POST REQUEST
            $code = $_REQUEST['code'];
            var_dump($code);
            $this->userKey = $code;
            die;
        }
// TODO state should be randomly generated and verified on the response

        if ($this->accessToken == null)
        {
            // TODO get access token
   //         $client = new Client();
   //         die('NO ACCESS TOKEN');
        }
/*        $oauth = new OAuth2Middleware(new NullGrantType);
        $oauth->setAccessToken([
            // Your access token goes here
            'access_token' => $this->accessToken,
            // You can specify 'expires_in` as well, but it doesn't make much sense in this scenario
            // You can also specify 'scope' => 'list of scopes'
        ]);
*/

    //    $redirectUrl = $this->redirectUriLogin;
        $redirectUrl = 'https://www.incratec.com/__api.php';
        $state = urlencode($this->redirectUriLogin.'?cb=access');

        $authRedirect = 'https://api.sonos.com/login/v3/oauth?client_id='.$this->clientId.'&response_type=code&state='.$state.'&scope=playback-control-all&redirect_uri='.urlencode($redirectUrl);
//var_dump($authRedirect);die;
        return header('Location: '.$authRedirect, true, 302);
    }

}