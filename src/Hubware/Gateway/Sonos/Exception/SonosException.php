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

namespace Hubware\Gateway\Sonos\Exception;

/**
 * base class for Sonos exceptions
 *
 */
class SonosException extends \Exception
{

    /**
     * @param string $exceptionDetails contains the error message from api,
     *               if available
     */
    public function __construct(string $exceptionDetails)
    {
        parent::__construct($exceptionDetails, 0, null);
    }
}