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
 * A single music track or audio file. Tracks are identified by type, which
 * determines the key values for the object types included. The following
 * fields are shared by all types of tracks.
 *
 * @see https://developer.sonos.com/reference/types/playback-objects/#track
 */
class Track
{
    /**
     * (Optional) The unique music service object ID for this track;
     * identifies the track within the music service from which the track
     * originated. See below for details.
     *
     * @var MusicObjectId
     */
    public $id;

    /**
     * (Optional) The name of the track (see track type: track values below).
     * @var string
     */
    public $name;

    /**
     * (Optional) Set to false to prevent audio crossfade from involving
     * this track regardless of the prevailing playback policy. Default is true.
     *
     * @var bool
     */
    public $canCrossfade = true;

    /**
     * (Optional) Set to false to prevent skipping this track regardless of
     * the prevailing playback policy. Default is true.
     *
     * @var bool
     */
    public $canSkip = true;

    /**
     * (Optional) The duration of the track, in milliseconds, for example,
     * 210000 for a 3 and a half minute song.
     *
     * @var integer
     */
    public $durationMillis;

    /**
     *  (Optional) A URL to an image for the track, for example, an album cover.
     * Typically a JPG or PNG. Maximum length of 1024 characters. Where possible,
     * this URL should be absolute Internet-based (as opposed to local LAN) and
     * not require authorization to retrieve.
     *
     * @var string
     */
    public $imageUrl;

    /**
     * (Optional) The track gain. This field allows for floating value points.
     *
     * The player applies this normalization to track audio, overriding any value
     * found in the actual media. Your service should pass the best dB value
     * that you have. Players will interpret this as needed and clamp any values
     * outside of this range. Currently, this range is from -8 dB to +8 dB.
     * For example, the player treats a value of 12 as if it were 8. This
     * range is subject to change at our discretion.
     *
     * @var float
     */
    public $replayGain;

    /**
     * (Optional) A tag for the track. Currently the only value is “TAG_EXPLICIT”
     * to indicate that the track includes explicit content. Players will not
     * include this key and value if it is empty.
     *
     * @var string[] enum
     */
    public $tags = [];

    /**
     * (Optional) The type of track. Maximum length of 15 characters. Currently
     * the only value for this parameter is track, which is also the default.
     * Use track to describe a normal audio or music track with a name, album,
     * and artist. See below for details.
     *
     * @var string
     */
    public $type;

    /**
     * (Output only)  The name and id of the music service where the track
     * originated. This field is only present in events such as the
     * metadataStatus event.
     *
     * @var Service
     */
    public $service;




    /** type: track - specific fields */

    /* name -> already included */

    /**
     * (Optional) The number of the track on the album.
     * @var int
     */
    public $trackNumber;

    /**
     * The artist for the track. See the artist object type below for details.
     *
     * @var Artist
     */
    public $artist;

    /**
     * (Optional) The album containing the track, as determined by the source
     * of the track. See the album object type below for details.
     *
     * @var Album
     */
    public $album;
}