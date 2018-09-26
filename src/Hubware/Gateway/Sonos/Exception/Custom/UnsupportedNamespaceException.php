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
 * When your app sends a namespace that is not recognized by the player, you’ll
 * receive an ERROR_UNSUPPORTED_NAMESPACE error response. Note that namespaces
 * are case-sensitive.
 *
 * For example, if you misspelled the namespace, the player responds with an
 * ERROR_UNSUPPORTED_NAMESPACE in the global namespace
 *
 * @see https://developer.sonos.com/reference/types/globalerror/#ERROR-UNSUPPORTED-NAMESPACE
 */
class UnsupportedNamespaceException extends CustomException
{
    const ERROR_CODE = 'ERROR_UNSUPPORTED_NAMESPACE';

}