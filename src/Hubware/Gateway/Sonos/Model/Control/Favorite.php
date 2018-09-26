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

namespace Hubware\Gateway\Sonos\Model\Control;


use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * favorite information
 */
class Favorite extends SonosBase
{
    /**
     * An identifier for the favorite.
     * @var string
     */
    public $id;

    /**
     * A user-identifiable name.
     * @var string
     */
    public $name;

    /**
     * (Optional) Provides more context to the user.
     * @var string
     */
    public $description;

    /**
     * The SMAPI itemType. This is not yet implemented.
     * @var string enum of item type
     */
    public $type;

    /**
     * (Optional) A single image URL. The default image for the favorite.
     * @var string url
     */
    public $imageUrl;

    /**
     * (Optional) Some favorites are compilations of multiple content.
     * In this case, multiple images may be associated with the favorite.
     * A client application can create an image compilation from these URLs.
     * This is not yet implemented.
     *
     * @var string[] url
     */
    public $imageCompilation = [];

    /**
     * (Optional) Identifies the content provider.
     * @var Service
     */
    public $service;
}