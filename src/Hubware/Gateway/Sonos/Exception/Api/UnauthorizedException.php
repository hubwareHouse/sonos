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
 * The client token or API key is invalid, or the client does not have
 * sufficient permission to run the command.
 *
 * @see https://developer.sonos.com/build/direct-control/control/
 */
class UnauthorizedException extends SonosException
{

}