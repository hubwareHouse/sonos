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
 * An ERROR_COMMAND_FAILED indicates an internal player error. For example,
 * if your app sends a setVolume command to set the volume to 20 on a CONNECT
 * player that has been configured to have a fixed line-out setting, the
 * player will send this response to your app.
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR-COMMAND-FAILED
 */
class CommandFailedException extends CustomException
{
    const ERROR_CODE = 'ERROR_COMMAND_FAILED';

}