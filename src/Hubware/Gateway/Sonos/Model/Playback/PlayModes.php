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

namespace Hubware\Gateway\Sonos\Model\Playback;

/**
 * Sonos players support audio play modes including shuffle, repeat, and
 * crossfade. Your app can receive notifications for changes with the
 * playbackStatus event and set the current play modes with the setPlayModes
 * command.
 *
 * The playModes object defines the functionality of one or more play modes.
 * Play modes are either enabled or disabled. Sonos supports the following
 * play modes:
 *
 * @see https://developer.sonos.com/reference/types/play-modes/
 */
class PlayModes
{
    /**
     * Repeat tracks.
     *
     * When playback reaches the end of the current queue of tracks,
     * playback will wrap around and continue from the beginning of the queue.
     *
     * @var bool
     */
    public $repeat;

    /**
     * Repeat the current track indefinitely until this mode is disabled or
     * your app explicitly changes the playhead position to a different track,
     * for example, by skipping to the next track, a previous track, or a
     * specific track in a cloud queue.
     *
     * @var bool
     */
    public $repeatOne;

    /**
     * 	Play the tracks in the queue in a randomly shuffled order.
     *
     * @var bool
     */
    public $shuffle;

    /**
     * Fade out and mix the end of a track with the start of the next track as
     * it is being faded in, creating a crossfade effect.
     *
     * @var bool
     */
    public $crossfade;
}