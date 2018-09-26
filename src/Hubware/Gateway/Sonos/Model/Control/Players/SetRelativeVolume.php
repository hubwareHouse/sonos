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

namespace Hubware\Gateway\Sonos\Model\Control\Players;

/**
 * Use the setRelativeVolume command in the playerVolume namespace to increase
 * or decrease volume for a player and unmute the player if muted.
 *
 * @see https://developer.sonos.com/reference/control-api/playervolume/setrelativevolume/
 */
class SetRelativeVolume
{
    /**
     * (Optional) Between -100 and 100 to indicate the amount to increase
     * or decrease the volume for the player.
     * If your app submits a number outside of this range, you will receive
     * an ERROR_INVALID_PARAMETER error. The player adds this value to the
     * current volume and keeps the result in the range of 0 to 100.
     *
     * @var int -100 to 100
     */
    public $volumeDelta;

    /**
     * (Optional) true to mute the player or false to unmute the player.
     *
     * @var bool
     */
    public $muted;
}