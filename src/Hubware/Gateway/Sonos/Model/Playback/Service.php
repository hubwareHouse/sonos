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
 * The music service identifier or a pseudo-service identifier in the case of
 * local library.
 *
 * @see https://developer.sonos.com/reference/types/playback-objects/#Service
 */
class Service
{
    const SERVICE_LOCAL_LIBRARY = 'locallibrary';
    /**
     * (Optional) The unique identifier for the music service.
     *
     * This can be the same as the serviceId value in the MusicObjectId.
     * A value of “locallibrary” represents the content available from the
     * local library.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the service.
     *
     * @var string
     */
    public $name;

    /**
     * (Optional) A URL to an image (typically a JPG or PNG) representing the
     * music service. This should be absolute Internet-based and require no
     * authorization to retrieve.
     *
     * @var string?
     */
    public $imageUrl;

    public function isLocalLibrary()
    {
        return $this->id === self::SERVICE_LOCAL_LIBRARY;
    }
}