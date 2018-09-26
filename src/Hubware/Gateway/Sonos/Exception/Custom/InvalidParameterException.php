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
 * If your app provides an invalid parameter, it will receive an
 * ERROR_INVALID_PARAMETER from the player.
 *
 * For example, if your app sends a setVolume command with a volume outside
 * the valid range, such as -1 when the range is 0 to 100.
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR-INVALID-PARAMETER
 */
class InvalidParameterException extends CustomException
{
    const ERROR_CODE = 'ERROR_INVALID_PARAMETER';

}