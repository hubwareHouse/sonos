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

use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * The playerVolume event in the playerVolume namespace indicates changes to
 * the volume for a player, the mute state for the player and whether
 * the player volume is fixed or can be changed.
 *
 * When your app subscribes to the playerVolume namespace and receives this
 * event, it can update its user interface to reflect the latest group volume
 * and group mute state. For example, if a user configures a CONNECT to have a
 * fixed line-out volume, your app will receive a playerVolume event with the
 * fixed parameter value of true. Your app should then disable its volume
 * slider so users know that volume adjustments are not permitted.
 *
 *
 * @see https://developer.sonos.com/reference/control-api/playerVolume/playerVolume/
 */
class PlayerVolume extends SonosBase
{

    /**
     * Indicates whether or not the volume for the player is fixed or
     * changeable. If true, your app cannot change the group volume. If
     * false, your app can change the group volume. For example, the CONNECT
     * has fixed-volume line-level output.
     *
     * @var bool
     */
    public $fixed;

    /**
     * Indicates whether or not the group is muted. If true, the group is muted.
     * If false, the group is not muted.
     *
     * @var bool
     */
    public $muted;

    /**
     * Indicates the volume of the player, between 0 and 100.
     *
     * @var int
     */
    public $volume;
}