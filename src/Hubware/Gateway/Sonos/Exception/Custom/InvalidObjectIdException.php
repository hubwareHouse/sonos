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
 * In certain cases your app is required to provide a matching object identifier
 * for the command to be executed. When your app fails to provide the correct
 * object identifier, it will receive an ERROR_INVALID_OBJECT_ID error.
 *
 * For example, the seek command in the playbackSession namespace requires
 * that your app provides the itemId of the current item. If your app sends a
 * seek command with an itemId that is not the currently playing or paused item
 * in the cloud queue, it will receive this response.
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR-INVALID-OBJECT-ID
 */
class InvalidObjectIdException extends CustomException
{
    const ERROR_CODE = 'ERROR_INVALID_OBJECT_ID';

}