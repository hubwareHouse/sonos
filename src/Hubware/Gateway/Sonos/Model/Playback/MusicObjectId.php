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
 * The music object identifier for the item in a music service. This identifies
 * the content within a music service, the music service, and the account
 * associated with the content.
 *
 * @see https://developer.sonos.com/reference/types/playback-objects/#MusicObjectId
 */
class MusicObjectId
{
    /**
     * The unique identifier for the particular piece of content within the
     * music service. Maximum length of 256 characters.
     *
     * @var string
     */
    public $objectId;

    /**
     * (Optional) The unique identifier for the music service.
     * Maximum length of 20 characters.
     *
     * If you omit this, the player uses the accountId (if provided) to look up
     * the service ID.
     *
     * @var string
     */
    public $serviceId;

    /**
     * (Optional) The music service account to use on Sonos for playback in the
     * session. See account matching for details.
     *
     * Maximum length of 13 characters.
     *
     * If omitted and the household has multiple accounts for the music service,
     * Sonos will use the accountId based on the following order of precedence
     * (if the accountId is omitted from the first item below, it uses the next item):
     *   1. In the item metadata from the GET /itemWindow endpoint (for example, from the id for a track).
     *   2. In the container metadata from the GET /context endpoint.
     *   3. In the command used to load the content or queue up the tracks (such as createSession, joinOrCreateSession, or  loadCloudQueue).
     *
     * While optional, you should provide the accountId using one of these methods.
     *
     * @var string
     */
    public $accountId;
}