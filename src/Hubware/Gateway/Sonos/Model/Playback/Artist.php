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
 * The artist of the track.
 */
class Artist
{
    /**
     * (Optional) The unique music service object id for this artist;
     * identifies the artist within the music service from which the track
     * originated. See below for details.
     *
     * @var MusicObjectId
     */
    public $id;

    /**
     * The name of the artist. Maximum length of 76 characters.
     *
     * @var string
     */
    public $name;

    /**
     * (Optional) A URL to an image of the artist, typically a JPG or PNG.
     *
     * @var string
     */
    public $imageUrl;
}