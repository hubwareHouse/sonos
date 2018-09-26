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
use Hubware\Gateway\Sonos\Exception\Api\BadRequestException;
use Hubware\Gateway\Sonos\Exception\Api\ForbiddenException;
use Hubware\Gateway\Sonos\Exception\Api\GoneException;
use Hubware\Gateway\Sonos\Exception\Api\InternalServerError;
use Hubware\Gateway\Sonos\Exception\Api\NotFoundException;
use Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException;
use Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException;
use Hubware\Gateway\Sonos\Exception\ExceptionFactory;
use Hubware\Gateway\Sonos\Exception\SonosException;
use Hubware\Gateway\Sonos\Model\Control\Group;
use Hubware\Gateway\Sonos\Model\Control\Groups\GroupVolume;
use Hubware\Gateway\Sonos\Model\Control\Groups\PlaybackStatus;
use Hubware\Gateway\Sonos\Model\Control\Household;
use Hubware\Gateway\Sonos\Model\Control\Player;
use Hubware\Gateway\Sonos\Model\Control\Players\PlayerVolume;
use Hubware\Gateway\Sonos\Model\Control\Players\SetRelativeVolume;
use Hubware\Gateway\Sonos\Model\ModelSerializer;
use Teapot\StatusCode;

class ApiRestCommunicationHandler
{
    const API_BASE = 'https://api.ws.sonos.com/control/api/';
    const API_VERSION = 'v1';
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_DELETE = 'DELETE';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * client class
     *
     * @var Client
     */
    private $restClient;

    /**
     * @var ModelSerializer
     */
    private $modelSerializer;

    /**
     * handles the communication to the SONOS rest api
     *
     */
    public function __construct()
    {
        $this->modelSerializer = new ModelSerializer();
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    protected function getClient()
    {
        if ($this->restClient == null)
        {
            $config = [
                'Content-Type' => 'application/json',
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept'        => 'application/json',
                ],
                'base_uri' => 'https://api.ws.sonos.com',
            ];

            $this->restClient = new Client($config);
        }

        return $this->restClient;
    }

    /**
     * call an api
     * @param        $url
     * @param string $method
     * @param null   $data
     *
     * @return string
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GoneException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws SonosException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws \JsonMapper_Exception
     */
    protected function getResponse($url, $method = self::METHOD_GET, $data = null) : string
    {
        $client = $this->getClient();
        $url = self::API_BASE.self::API_VERSION.$url;

        $requestParams = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept'        => 'application/json',
            ],
            'base_uri' => 'https://api.ws.sonos.com',
//    'debug' => true,
        ];

        if ($method == self::METHOD_GET)
        {
            $response = $client->get($url, $requestParams);
        }
        elseif ($method == self::METHOD_DELETE)
        {
            $response = $client->delete($url, $requestParams);
        } else {
            if ($data != null && !is_string($data)) {
                $data = json_encode($data);
            }
            if ($data != null && strlen($data) > 0)
            {
                $requestParams['body'] = $data;
            }

            $response = $client->post($url, $requestParams);
        }

        // validate header - any error?
        $sonosType = $response->hasHeader('X-Sonos-Type')
            ? $response->getHeader('X-Sonos-Type')[0]
            : null;

        switch($response->getStatusCode())
        {
            case StatusCode::OK:
                break;

            case StatusCode::BAD_REQUEST:
                throw new BadRequestException('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;

            case StatusCode::UNAUTHORIZED:
                throw new UnauthorizedException('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;

            case StatusCode::FORBIDDEN:
                throw new ForbiddenException('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;
            case StatusCode::NOT_FOUND:
                throw new NotFoundException('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;

            case StatusCode::GONE:
                throw new GoneException('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;

            case StatusCode\RFC\RFC6585::TOO_MANY_REQUESTS:
                throw new TooManyRequestsException('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;

            case StatusCode::INTERNAL_SERVER_ERROR:
                throw new InternalServerError('Request was '.$url.' as '.$method.' with data '.print_r($data));
                break;

            case 499: // custom
                $body = (string)$response;
                if (strlen($body) > 0) $body = $this->modelSerializer->transformGlobalError(json_decode($body));
                throw ExceptionFactory::handleCustomException($body, $sonosType);
                break;

            default:
                throw new SonosException('Unsupported status code '.$response->getStatusCode());
                break;
        }

        return $response->getBody();
    }

    /**
     * get a list of households for the given account
     *
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GoneException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws \JsonMapper_Exception
     * @throws SonosException
     *
     *
     * @return Household[]
     */
    public function getHouseholds()
    {
        $result = [];

        $response = $this->getResponse('/households');
        $householdResponse = json_decode($response);

        foreach($householdResponse->households as $householdObj)
        {
            /** @var Household $household */
            $household = $this->modelSerializer->transformHousehold($householdObj);
            $household->setApi($this);
            $result[] = $household;
        }

        return $result;
    }

    /**
     * return groups of given household
     * @param string $householdId
     *
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GoneException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws SonosException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws \JsonMapper_Exception
     *
     * @return Group[]
     */
    public function getGroups(string $householdId)
    {
        $result = [];
        $groupResponse = $this->getResponse('/households/'.$householdId.'/groups');
        $groupsJson = json_decode($groupResponse);

        foreach($groupsJson->groups as $groupJsonObj)
        {
            /** @var Group $group */
            $group = $this->modelSerializer->transformGroup($groupJsonObj);
            $group->setApi($this);
            $result[] = $group;
        }

        return $result;
    }

    /**
     * return player of given household
     *
     * @param string $householdId
     *
     * @return Player[]
     *
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GoneException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws SonosException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws \JsonMapper_Exception
     */
    public function getPlayers(string $householdId)
    {
        $result = [];
        $players = $this->getResponse('/households/'.$householdId.'/players');
        $playersJson = json_decode($players);

        foreach($playersJson->players as $playerJson)
        {
            /** @var Player $player */
            $player = $this->modelSerializer->transformPlayer($playerJson);
            $player->setApi($this);
            $result[] = $player;
        }

        return $result;
    }


    /** PlayerVolume namespace
     *
     * @param string $playerId
     *
     * @return PlayerVolume
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GoneException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws SonosException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws \JsonMapper_Exception
     */

    public function getPlayerVolume(string $playerId) : PlayerVolume
    {
        $playerVolumeString= $this->getResponse('/players/'.$playerId.'/playerVolume');
        $playerVolumeObj = json_decode($playerVolumeString);

        /** @var PlayerVolume $result */
        $result = $this->modelSerializer->transformPlayerVolume($playerVolumeObj);
        $result->setApi($this);

        return $result;
    }

    /**
     * @param string       $playerId
     * @param PlayerVolume $playerVolume
     *
     * @return bool
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GoneException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws SonosException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws \JsonMapper_Exception
     */
    public function setPlayerVolume(string $playerId, PlayerVolume $playerVolume) : bool
    {
        $this->getResponse(
            '/players/'.$playerId.'/playerVolume',
            self::METHOD_POST,
            $playerVolume
        );
        return true;
    }

    public function setPlayerVolumeRelative(string $playerId, SetRelativeVolume $setRelativeVolume) : bool
    {
        $this->getResponse(
            '/players/'.$playerId.'/playerVolume/relative',
            self::METHOD_POST,
            $setRelativeVolume
        );
        return true;
    }

/* GROUPS namespace */


    public function setGroupPlaying(string $groupId) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/playback/play',
            self::METHOD_POST
        );
        return true;
    }

    public function setGroupPause(string $groupId) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/playback/pause',
            self::METHOD_POST
        );
        return true;
    }

    public function setGroupVolume(string $groupId, GroupVolume $groupVolume) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/groupVolume',
            self::METHOD_POST,
            $groupVolume
        );
        return true;
    }
    public function setGroupVolumeMute(string $groupId, GroupVolume $groupVolume) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/groupVolume/mute',
            self::METHOD_POST,
            $groupVolume
        );
        return true;
    }

    public function getGroupVolume(string $groupId) : GroupVolume
    {
        $groupVolumeString = $this->getResponse('/groups/'.$groupId.'/groupVolume');
        $groupVolumeObj = json_decode($groupVolumeString);

        /** @var GroupVolume $result */
        $result = $this->modelSerializer->transformGroupVolume($groupVolumeObj);
        $result->setApi($this);

        return $result;
    }

    public function setGroupVolumeRelative(string $groupId, SetRelativeVolume $setRelativeVolume) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/groupVolume/relative',
            self::METHOD_POST,
            $setRelativeVolume
        );
        return true;
    }

    public function subscribeGroupVolume(string $groupId) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/groupVolume/subscription',
            self::METHOD_POST,
            ''
        );
        return true;
    }

    public function deleteSubscriptionGroupVolume(string $groupId) : bool
    {
        $this->getResponse(
            '/groups/'.$groupId.'/groupVolume/subscription',
            self::METHOD_DELETE,
            ''
        );
        return true;
    }

    /* playback */

    public function getGroupPlaybackStatus(string $groupId) : PlaybackStatus
    {
        $playbackStatusString = $this->getResponse('/groups/'.$groupId.'/playback');
        $playbackStatusObj = json_decode($playbackStatusString);

        /** @var PlaybackStatus $result */
        $result = $this->modelSerializer->transformPlaybackStatus($playbackStatusObj);
        $result->setApi($this);

        return $result;
    }

}