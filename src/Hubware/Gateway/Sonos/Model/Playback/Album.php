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
 * The album for the track.
 */
class Album
{
    /**
     * (Optional) The unique music service object id for this album; identifies
     * the album within the music service from which the track originated.
     * See below for details.
     *
     * @var MusicObjectId
     */
    public $id;

    /**
     * The name of the album. Maximum length of 76 characters.
     *
     * @var string
     */
    public $name;

    /**
     * (Optional) The artist for the album. See below for details.
     *
     * @var Artist
     */
    public $artist;

    /**
     * (Optional) A URL to an image of the album, typically a JPG or PNG.
     *
     * @var string
     */
    public $imageUrl;
}