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
 * Item
 *
 * An item in a queue. Used for cloud queue tracks and radio stations that have
 * track-like data for the currently playing content. For example, the
 * currentItem and nextItem parameters in the metadataStatus event are item
 * object types.
 *
 * @see https://developer.sonos.com/reference/types/playback-objects/#item
 */
class Item
{

    /**
     * (Optional) The cloud queue itemId for the track. Only present if the
     * track is from a cloud queue. Maximum length of 128 characters.
     *
     * @var string
     */
    public $id;

    /**
     * The track data. See Track for details.
     * @var Track
     */
    public $track;

    /**
     * (Optional) Whether the track was deleted or not; true if deleted and
     * false if not. This should be used by the cloud queue server.
     *
     * @var bool
     */
    public $deleted;

    /**
     * (Optional) Certain policies can be overridden by item.
     * See the policies object type below for details.
     *
     * @var Policies
     */
    public $policies;
}