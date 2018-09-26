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

namespace Hubware\Gateway\Sonos\Model;



use Hubware\Gateway\Sonos\Model\Control\Account;
use Hubware\Gateway\Sonos\Model\Control\Group;
use Hubware\Gateway\Sonos\Model\Control\Groups\GroupVolume;
use Hubware\Gateway\Sonos\Model\Control\Groups\PlaybackStatus;
use Hubware\Gateway\Sonos\Model\Control\Household;
use Hubware\Gateway\Sonos\Model\Control\Player;
use Hubware\Gateway\Sonos\Model\Control\Players\PlayerVolume;
use Hubware\Gateway\Sonos\Model\Control\Session;
use Hubware\Gateway\Sonos\Model\Error\GlobalError;

class ModelSerializer
{
    /**
     * @var
     */
    private $jsonMapper;


    public function __construct()
    {
        $this->jsonMapper = new \JsonMapper();
    }

    /**
     * transform json object to Account
     * @param object $jsonObject
     *
     * @return Account
     * @throws \JsonMapper_Exception
     */
    public function transformAccount(object $jsonObject): Account
    {
        /** @var Account $result */
        $result = $this->jsonMapper->map($jsonObject, new Account());

        return $result;
    }

    /**
     * transform json object to Household
     * @param object $jsonObject
     *
     * @return Household
     * @throws \JsonMapper_Exception
     */
    public function transformHousehold(object $jsonObject): Household
    {
        /** @var Household $result */
        $result = $this->jsonMapper->map($jsonObject, new Household());

        return $result;
    }

    /**
     * transform json object to Group
     * @param object $jsonObject
     *
     * @return Group
     * @throws \JsonMapper_Exception
     */
    public function transformGroup(object $jsonObject): Group
    {
        /** @var Group $result */
        $result = $this->jsonMapper->map($jsonObject, new Group());

        return $result;
    }

    /**
     * @param object $jsonObject
     *
     * @return GroupVolume
     * @throws \JsonMapper_Exception
     */
    public function transformGroupVolume(object $jsonObject) : GroupVolume
    {
        /** @var GroupVolume $result */
        $result = $this->jsonMapper->map($jsonObject, new GroupVolume());

        return $result;
    }

    /**
     * transform json object to Player
     * @param object $jsonObject
     *
     * @return Player
     * @throws \JsonMapper_Exception
     */
    public function transformPlayer(object $jsonObject): Player
    {
        /** @var Player $result */
        $result = $this->jsonMapper->map($jsonObject, new Player());

        return $result;
    }

    /**
     * @param object $jsonObject
     *
     * @return PlayerVolume
     * @throws \JsonMapper_Exception
     */
    public function transformPlayerVolume(object $jsonObject) : PlayerVolume
    {
        /** @var PlayerVolume $result */
        $result = $this->jsonMapper->map($jsonObject, new PlayerVolume());

        return $result;
    }

    /**
     * transform json object to Session
     * @param object $jsonObject
     *
     * @return Session
     * @throws \JsonMapper_Exception
     */
    public function transformSession(object $jsonObject): Session
    {
        /** @var Session $result */
        $result = $this->jsonMapper->map($jsonObject, new Session());

        return $result;
    }

    /**
     * @param object $jsonObject
     *
     * @return GlobalError
     * @throws \JsonMapper_Exception
     */
    public function transformGlobalError(object $jsonObject) : GlobalError
    {
        /** @var GlobalError $result */
        $result = $this->jsonMapper->map($jsonObject, new GlobalError());

        return $result;
    }

    /**
     * @param object $jsonObject
     *
     * @return PlaybackStatus
     * @throws \JsonMapper_Exception
     */
    public function transformPlaybackStatus(object $jsonObject) : PlaybackStatus
    {
        /** @var PlaybackStatus $result */
        $result = $this->jsonMapper->map($jsonObject, new PlaybackStatus());

        return $result;
    }

}