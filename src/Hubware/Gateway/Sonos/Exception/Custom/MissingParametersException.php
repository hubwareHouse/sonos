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
 * Class MissingParametersException
 *
 * If your app does not send a required parameter in the header or body, the
 * player responds with this error.
 *
 * For example, if your app sends a setVolume command in the groupVolume
 * namespace, the player expects the target ID parameters householdId and
 * groupId to be present in the command header (see Control for details about
 * target ID parameters). If your setVolume command was missing a householdId
 * in the header, your app would receive this error.
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR-MISSING-PARAMETERS
 */
class MissingParametersException extends CustomException
{
    const ERROR_CODE = 'ERROR_MISSING_PARAMETERS';
}