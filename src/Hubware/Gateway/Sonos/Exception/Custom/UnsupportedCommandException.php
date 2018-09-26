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

namespace Hubware\Gateway\Sonos\Exception\Custom;


/**
 * When your app sends a command that is not recognized by the player, you’ll
 * receive an ERROR_UNSUPPORTED_COMMAND error response for the target namespace
 * and householdId. Note that commands are case-sensitive.
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR_UNSUPPORTED_COMMAND
 */
class UnsupportedCommandException extends CustomException
{
    const ERROR_CODE = 'ERROR_UNSUPPORTED_COMMAND';

}