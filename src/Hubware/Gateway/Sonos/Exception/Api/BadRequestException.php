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
 * Syntax error in the command, missing or invalid parameters.
 *
 * @see https://developer.sonos.com/build/direct-control/control/
 */
class BadRequestException extends SonosException
{

}