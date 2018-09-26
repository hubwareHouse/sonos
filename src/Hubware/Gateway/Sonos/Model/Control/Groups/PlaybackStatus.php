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


use Hubware\Gateway\Sonos\Model\Playback\PlayModes;
use Hubware\Gateway\Sonos\Model\Playback\Policies;
use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * The playbackStatus type in the playback namespace indicates changes to the
 * group playback state, such as idle, buffering, paused, or playing, and the
 * current playback position in the track. If the audio source is a cloud queue,
 * this event also provides information about the cloud queue source, like the
 * queueVersion and the current item’s itemId. It also can provide playback
 * policies and modes. This object type can be a response to a command or an
 * asynchronous event sent to apps subscribed to the playback namespace.
 *
 * The initial state of a group after startup is PLAYBACK_STATE_IDLE. When a
 * user starts playing audio on a group, it transitions to
 * PLAYBACK_STATE_BUFFERING and PLAYBACK_STATE_PLAYING, or it may skip the
 * buffering state and go straight to playing. Depending on the audio source,
 * pausing playback may cause the group to go to either PLAYBACK_STATE_PAUSED
 * or PLAYBACK_STATE_IDLE. For example, streaming audio sources, such as
 * Internet radio stations, will be in PLAYBACK_STATE_IDLE when paused.
 * A group can also transition to PLAYBACK_STATE_IDLE after a playback
 * error occurs.
 *
 * Your app will only be notified of changes to the current track position
 * that result from any user action to seek to a new track position, a new
 * track starting or the last track ending, or a playback error. If a track
 * is playing normally on a group, your app will not receive playbackStatus
 * events while the track position progresses without errors. If your app has
 * a progress bar, you should update it with a local timer when playing
 * normally.
 *
 * You will receive the item ID and offset position for the current item as
 * well as for the previous item. For example, when a user skips from one
 * track to another, you’ll receive the previousItemId and
 * previousPositionMillis for the previous track, as well as the itemId and
 * positionMillis for the currently playing track. If the user pauses the
 * currently playing track, the previous track and position will be the same
 * as the currently playing track and position. If the user seeks within the
 * same track, the previous track will be the same as the currently playing
 * track, but the position will be different.
 *
 * @package Hubware\Gateway\Sonos\Model\Control\Groups
 */
class PlaybackStatus extends SonosBase
{
    /**
     * The group is buffering audio. This is a transitional state before the
     * audio starts playing.
     */
    const STATE_BUFFERING = 'PLAYBACK_STATE_BUFFERING';

    /**
     * Playback is not playing or paused, such as when the queue is empty or
     * a source cannot be paused (such as streaming radio).
     */
    const STATE_IDLE = 'PLAYBACK_STATE_IDLE';

    /**
     * Playback is paused while playing content that can be paused and resumed.
     */
    const STATE_PAUSED = 'PLAYBACK_STATE_PAUSED';

    /**
     * The group is playing audio.
     */
    const STATE_PLAYING = 'PLAYBACK_STATE_PLAYING';

    /**
     * The item identifier of the current track, if the audio source is a
     * cloud queue.
     *
     * @var string
     */
    public $itemId;

    /**
     * The playback state. See the list below.
     *
     * @var string
     */
    public $playbackState;

    /**
     * The set of currently effective playModes for the context.
     *
     * @var \Hubware\Gateway\Sonos\Model\Playback\PlayModes
     */
    public $playModes;

    /**
     * The set of allowed transport actions as defined by the playback policies
     * calculated by the player.
     *
     * @var \Hubware\Gateway\Sonos\Model\Playback\Policies
     */
    public $availablePlaybackActions;

    /**
     * The offset position within the current track in milliseconds.
     *
     * @var int
     */
    public $positionMillis;

    /**
     * The ID of the item prior to a playback state change. This indicates what
     * was playing when an action triggered the playbackStatus event.
     *
     * @var string
     */
    public $previousItemId;

    /**
     * The last position in the previous item.
     *
     * @var string ???
     */
    public $previousPositionMillis;

    /**
     * The last cloud queue change state identifier cached by the player.
     *
     * This could have been from:
     *    - the last GET /itemWindow or GET /version response.
     *    - a loadCloudQueue or skipToItem response.
     *
     * This is omitted when the value is unknown, for example, if the server
     * did not respond to a query.
     *
     * @var int
     */
    public $queueVersion;

    public function isStateBuffering() : bool
    {
        return $this->playbackState == self::STATE_BUFFERING;
    }

    public function isStatePlaying() : bool
    {
        return $this->playbackState == self::STATE_PLAYING;
    }

    public function isStatePaused() : bool
    {
        return $this->playbackState == self::STATE_PAUSED;
    }

    public function isStateIdle() : bool
    {
        return $this->playbackState == self::STATE_IDLE;
    }
}