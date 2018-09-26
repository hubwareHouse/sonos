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

namespace Hubware\Gateway\Sonos\Test\Model;

use Hubware\Gateway\Sonos\Model\Control\Group;
use Hubware\Gateway\Sonos\Model\Control\Groups\GroupVolume;
use Hubware\Gateway\Sonos\Model\Control\Groups\PlaybackStatus;
use Hubware\Gateway\Sonos\Model\Control\Household;
use Hubware\Gateway\Sonos\Model\Control\Player;
use Hubware\Gateway\Sonos\Model\Control\Players\PlayerVolume;
use Hubware\Gateway\Sonos\Model\Playback\PlayModes;
use Hubware\Gateway\Sonos\Model\Playback\Policies;

/**
 * provides sample entities, based on provided response test data
 */
class TestFactory
{


    public static function getHousehold() : Household
    {
        $res = new Household();
        $res->id = 'Sonos_12345';

        return $res;
    }

    /**
     * sample player
     */
    public static function getPlayer() : Player
    {
        $res = new Player();
        $res->id = 'RINCON_8HJLQE01RW4B21097';
        $res->name = 'Playroom';
        $res->icon = 'playroom';
        $res->websocketUrl = 'wss://192.168.55.135:1443/websocket/api';
        $res->softwareVersion = '38.5-43170-DevPreview';
        $res->deviceIds = [
            'RINCON_8HJLQE01RW4B21097'
        ];
        $res->apiVersion = '1.0.0-DevPreview+1234';
        $res->minApiVersion = '1.0.0';
        $res->capabilities = [
            "PLAYBACK",
            "CLOUD",
        ];

        return $res;
    }

    public static function getPlayerVolume() : PlayerVolume
    {
        $res = new PlayerVolume();
        $res->volume = 1;
        $res->muted = false;
        $res->fixed = false;

        return $res;
    }

    public static function getGroup() : Group
    {
        $res                = new Group();
        $res->id            = 'RINCON_7BHBFF96BF5A34300';
        $res->name          = 'Playroom';
        $res->coordinatorId = 'RINCON_8HJLQE01RW4B21097';
        $res->playbackState = 'PLAYBACK_STATE_IDLE';
        $res->playerIds     = [
            'RINCON_8HJLQE01RW4B21097'
        ];

        return $res;
    }

    public static function getGroupVolume() : GroupVolume
    {
        $res = new GroupVolume();
        $res->fixed = false;
        $res->muted = true;
        $res->volume = 80;

        return $res;
    }

    public static function getGroupPlaybackStatus()
    {
        $res = new PlaybackStatus();
        $res->playbackState = PlaybackStatus::STATE_BUFFERING;
        $res->queueVersion = 3;
        $res->itemId = 'abc';
        $res->positionMillis = 56750;

        $res->playModes = new PlayModes();
        $res->playModes->repeat = false;
        $res->playModes->repeatOne = false;
        $res->playModes->crossfade = true;
        $res->playModes->shuffle = false;

        $res->availablePlaybackActions = new Policies();
        $res->availablePlaybackActions->canSkip = true;
        $res->availablePlaybackActions->canSkipBack = false;
        $res->availablePlaybackActions->canSeek = false;
        $res->availablePlaybackActions->canRepeat = false;
        $res->availablePlaybackActions->canRepeatOne = false;
        $res->availablePlaybackActions->canCrossfade = true;
        $res->availablePlaybackActions->canShuffle = false;

        return $res;
    }

}