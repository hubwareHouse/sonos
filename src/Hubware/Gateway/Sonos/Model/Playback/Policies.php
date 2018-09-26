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
 * Playback Policy List
 *
 * The following playback policies apply to the playback context, which includes
 * the container, user account, and other parameters shown in the GET /context
 * endpoint.
 *
 * @see https://developer.sonos.com/build/content-service-get-started/play-audio/playback-policies/
 */
class Policies
{

    /**
     * Determines whether or not the player allows the user to crossfade.
     * If false, your app should not enable the ability to crossfade.
     *
     * @var bool
     */
    public $canCrossfade = true;

    /**
     * Determines whether or not the player allows the user to enable repeat
     * on the current item list. If false, your app should not enable the
     * ability to repeat.
     *
     * @var bool
     */
    public $canRepeat = true;

    /**
     * Determines whether or not the player allows the user to enable repeat
     * for the current item. If false, your app should not enable the ability
     * to repeat a single item.
     *
     * @var bool
     */
    public $canRepeatOne = true;

    /**
     * Determines whether or not the player reports playback progress
     * information after playback pauses for a certain amount of time. When
     * true, the player reports playback progress information, such as
     * offsetMillis. Your service can use this information to later resume
     * playback progress from where it paused.
     *
     * @var bool
     */
    public $canResume = false;

    /**
     * Determines whether or not the player allows the user to jump to a new
     * position within an item. When false, the seek command returns an error.
     * Note that this does not prevent users from repeating the item.
     *
     * @var bool
     */
    public $canSeek = true;

    /**
     * Determines whether or not the player allows the user to enable shuffle
     * on the current item list. When false, your app should not enable the
     * ability to shuffle.
     *
     * @var bool
     */
    public $canShuffle = true;

    /**
     * Determines whether or not the player allows the user to skip forward.
     * When true, the player will also look at the value of the limitedSkips
     * policy to determine whether or not to enforce skip limits.
     *
     * @var bool
     */
    public $canSkip = true;

    /**
     * Determines whether or not the player allows the user to skip backwards.
     * When false, the skipToPreviousTrack command returns an error.
     *
     * @var bool
     */
    public $canSkipBack = true;

    /**
     * Determines whether or not the player allows the user to jump to a new
     * item. When false, the skipToItem command returns an error.
     *
     * @var bool
     */
    public $canSkipToItem = true;

    /**
     * Determines whether or not the player allows the user to skip forward
     * when playback is paused. When false, the skipToNextTrack command returns
     * an error.
     *
     * @var bool
     */
    public $canSkipWhilePaused = true;

    /**
     * Determines whether or not the player enforces skip limits. When true,
     * the player sends a GET /itemWindow request when a user skips to the next
     * track or back to a previous one. The server can then decide the
     * appropriate action. The player waits for a response before performing
     * the action.
     *
     * Your server handles informing the player of whether or not any skips are
     * remaining. Use the reason parameter in these GET /itemWindow requests to
     * keep track of skips. When there are no skips remaining, set
     * skipLimitReached to true inside the limitedSkipsState object.
     *
     * @var bool
     */
    public $limitedSkips = false;

    /**
     * When true, players send a GET /itemWindow request on a user action, such
     * as play, pause, or skipping items in the queue. The server can then
     * decide the appropriate action. The player waits for a response before
     * performing the action.
     *
     * For example, a listener uses the hardware buttons to skip to the next
     * song. If your service has set notifyUserIntent to true, this action
     * sends a newGET /itemWindow request to your server. This request has a
     * reason parameter and that parameter will be “skipNext” to let your
     * server know that the user requested to skip the item.
     *
     * @var bool
     */
    public $notifyUserIntent = false;

    /**
     * Specifies an amount of time (in seconds) for playback to be paused before
     * Sonos marks the queue as expired. When the queue expires, Sonos disables
     * all transport operations except play and stop. Resuming playback in this
     * state forces the player to make a GET /itemWindow request.
     *
     * @var int
     */
    public $pauseTtlSec = 0;

    /**
     * Specifies a limit (in seconds) on continuous playback without interaction.
     * Sonos pauses playback when it reaches this specified duration. At this
     * point, pauseTtlSec will activate if it is configured.
     *
     * @var int
     */
    public $playTtlSec = 0;

    /**
     * Determines the number of upcoming tracks that can be displayed.
     * Defaults to unlimited if you don’t specify a value.
     *
     * @var int?
     */
    public $showNNextTracks;

    /**
     * Determines the number of previously played tracks that can be displayed.
     * Defaults to unlimited if you don’t specify a value.
     *
     * @var int?
     */
    public $showNPreviousTracks;
}