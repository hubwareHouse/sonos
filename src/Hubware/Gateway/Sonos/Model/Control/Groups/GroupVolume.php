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

namespace Hubware\Gateway\Sonos\Model\Control\Groups;

use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * The groupVolume namespace includes commands and events that enable your app
 * to control and update group volume and group mute state.
 *
 *
 * The groupVolume event in the groupVolume namespace indicates changes to group
 *    volume, the group mute state and whether the group volume is fixed or
 *    can be changed.
 *
 * When your app subscribes to the groupVolume namespace and receives this
 *    event, it can update its user interface to reflect the latest group
 *    volume and group mute state. For example, if a user configures a CONNECT
 *    to have a fixed line-out volume, your app will receive a groupVolume event
 *    with the fixed parameter value of true. Your app should then disable its
 *    volume slider so users know that volume adjustments are not permitted.
 *
 * Your app can expect to receive one or multiple groupVolume events
 *    associated with a single setVolume command. This is because the individual
 *    player volume changes become effective at different times, and groupVolume
 *    events may or may not be generated for each of the individual player
 *    volume changes. Your app is guaranteed to receive a final groupVolume
 *    event when all individual player volume changes are stable. See setVolume
 *    for more information on how group volume works.
 *
 * The group mute state is independent of the group volume value, so your
 *    app can have a separate mute button and update its state based on the
 *    muted parameter in the groupVolume event. The group coordinator also
 *    calculates the group mute state by taking into account all the individual
 *    player mute states. If all of the players in a group are muted, the muted
 *    state for the group is true. If at least one player in a group is not
 *    muted then the muted state for the group is false.
 *    See setMute for more information on the group mute state.
 *
 * @see https://developer.sonos.com/reference/control-api/group-volume/
 */
class GroupVolume extends SonosBase
{

    /**
     * A value indicating whether or not the group volume is fixed or changeable.
     *
     * If true, your app cannot change the group volume.
     * If false, your app can change the group volume.
     *
     * @var bool
     */
    public $fixed;

    /**
     * Indicates whether or not the group is muted.
     *
     * If true, the group is muted.
     * If false, the group is not muted.
     *
     * @var bool
     */
    public $muted;

    /**
     * Group volume as an integer between 0 and 100, inclusive.
     *
     * @var int
     */
    public $volume;
}