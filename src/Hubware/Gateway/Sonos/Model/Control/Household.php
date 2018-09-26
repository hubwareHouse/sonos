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

namespace Hubware\Gateway\Sonos\Model\Control;


use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * household information
 */
class Household extends SonosBase
{
    /**
     * id of household
     * @var string
     */
    public $id;

    /**
     *
     * @var Group[]
     */
    protected $groups = null;

    /**
     * @var Player[]
     */
    protected $players = null;

    /**
     * get groups - will be fetched lazy from the api, when this is requested
     *
     * @return Group[]
     *
     * @throws \Hubware\Gateway\Sonos\Exception\Api\BadRequestException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\ForbiddenException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\GoneException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\InternalServerError
     * @throws \Hubware\Gateway\Sonos\Exception\Api\NotFoundException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException
     * @throws \Hubware\Gateway\Sonos\Exception\SonosException
     * @throws \JsonMapper_Exception
     */
    public function getGroups()
    {
        if ($this->groups == null)
        {
            $this->groups = $this->getApi()->getGroups($this->id);
        }
        return $this->groups;
    }

    /**
     * @param string $groupId
     *
     * @return Group|null
     *
     * @throws \Hubware\Gateway\Sonos\Exception\Api\BadRequestException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\ForbiddenException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\GoneException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\InternalServerError
     * @throws \Hubware\Gateway\Sonos\Exception\Api\NotFoundException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException
     * @throws \Hubware\Gateway\Sonos\Exception\SonosException
     * @throws \JsonMapper_Exception
     */
    public function getGroupById(string $groupId) : ?Group
    {
        foreach($this->getGroups() as $group)
        {
            if ($group->id !== $groupId) continue;

            return $group;
        }

        return null;
    }


    /**
     * get first group with name $groupName , null if no group with this name
     * exists
     *
     * @param string $groupName
     *
     * @return Group|null
     *
     * @throws \Hubware\Gateway\Sonos\Exception\Api\BadRequestException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\ForbiddenException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\GoneException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\InternalServerError
     * @throws \Hubware\Gateway\Sonos\Exception\Api\NotFoundException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException
     * @throws \Hubware\Gateway\Sonos\Exception\SonosException
     * @throws \JsonMapper_Exception
     */
    public function getGroupByName(string $groupName) : ?Group
    {
        foreach($this->getGroups() as $group)
        {
            if ($group->name === $groupName) return $group;
        }
        return null;
    }

    /**
     * get groups - will be fetched lazy from the api, when this is requested
     *
     * @return Player[]
     *
     * @throws \Hubware\Gateway\Sonos\Exception\Api\BadRequestException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\ForbiddenException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\GoneException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\InternalServerError
     * @throws \Hubware\Gateway\Sonos\Exception\Api\NotFoundException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException
     * @throws \Hubware\Gateway\Sonos\Exception\SonosException
     * @throws \JsonMapper_Exception
     */
    public function getPlayers()
    {
        if ($this->players == null)
        {
            $this->players = $this->getApi()->getPlayers($this->id);
        }
        return $this->players;
    }

    /**
     * @param $playerId
     *
     * @return Player|null
     *
     *
     * @throws \Hubware\Gateway\Sonos\Exception\Api\BadRequestException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\ForbiddenException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\GoneException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\InternalServerError
     * @throws \Hubware\Gateway\Sonos\Exception\Api\NotFoundException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException
     * @throws \Hubware\Gateway\Sonos\Exception\SonosException
     * @throws \JsonMapper_Exception
     */
    public function getPlayerById($playerId) : ?Player
    {
        foreach($this->getPlayers() as $player)
        {
            if ($player->id === $playerId) return $player;
        }
        return null;
    }

    /**
     * get first player with provided name, or null
     *
     * @param $playerName
     *
     * @return Player|null
     *
     *
     * @throws \Hubware\Gateway\Sonos\Exception\Api\BadRequestException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\ForbiddenException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\GoneException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\InternalServerError
     * @throws \Hubware\Gateway\Sonos\Exception\Api\NotFoundException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\TooManyRequestsException
     * @throws \Hubware\Gateway\Sonos\Exception\Api\UnauthorizedException
     * @throws \Hubware\Gateway\Sonos\Exception\SonosException
     * @throws \JsonMapper_Exception
     */
    public function getPlayerByName($playerName) : ?Player
    {
        foreach($this->getPlayers() as $player)
        {
            if ($player->name === $playerName) return $player;
        }
        return null;
    }
}