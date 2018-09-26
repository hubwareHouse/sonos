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
 * If your app sends a malformed JSON command to the player, the player responds
 * with an ERROR_INVALID_SYNTAX in the target namespace:
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR-INVALID-SYNTAX
 */
class InvalidSyntaxException extends CustomException
{
    const ERROR_CODE = 'ERROR_INVALID_SYNTAX';

}