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

namespace Hubware\Gateway\Sonos\Exception\Api;

use Hubware\Gateway\Sonos\Exception\SonosException;

/**
 * The ID refers to a resource which doesn’t exist and isn’t known to have
 * existed. For example, an unknown namespace or command.
 *
 * @see https://developer.sonos.com/build/direct-control/control/
 */
class NotFoundException extends SonosException
{

}