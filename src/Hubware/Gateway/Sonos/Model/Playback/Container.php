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
 * A source of music.
 * A container represents a radio station, a playlist, a line-in source,
 * or some other source of audio.
 *
 * @see https://developer.sonos.com/reference/types/playback-objects/#container
 */
class Container
{
    /**
     * MusicObjectId    (Optional)
     * The unique music service object ID for this track; identifies the track
     * within the music service from which the track originated.
     * See below for details.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the source.
     * @var string
     */
    public $name;

    /**
     * (Optional) The type of source. Possible values are:
     *    - album — a playable album.
     *    - artist — an artist container.
     *    - audiobook — a type of tracklist where each track is a chapter in a book.
     *    - container — a non-playable container.
     *    - episode — a playable episode, podcast or otherwise.
     *    - item — a generic container. This is the default source if none is provided.
     *    - linein — a stream of audio representing some sort of physical or virtual audio input to the Sonos system.
     *    - playlist — a playlist or other collection of tracks.
     *    - show — a playable show.
     *    - station — a streaming or programmed radio station.
     *    - station.broadcast — a playable live broadcast station.
     *    - track — a single playable track.
     *    -tracklist — a container comprised of a finite list of tracks.
     *
     * @var string
     */
    public $type;

    /**
     * (Optional) A service object describing the music service for this music
     * source.
     *
     * @var Service
     */
    public $service;

    /**
     * (Optional)
     * A URL to an image (typically a JPG or PNG) representing the music
     * service. This should be absolute Internet-based and require no
     * authorization to retrieve.
     *
     * @var string
     */
    public $imageUrl;

    /**
     * (Optional) A tag for the container. Currently the only value is
     * “TAG_EXPLICIT” to indicate that the contents of the container include
     * explicit content. Players will not include this key and value if it is
     * empty.
     *
     * @var string[] enum
     */
    public $tags = [];
}