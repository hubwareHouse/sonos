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

use Hubware\Gateway\Sonos\Exception\SonosException;
use Hubware\Gateway\Sonos\Model\Error\GlobalError;

/**
 * Playback, session, and other Control API errors. Sonos includes a
 * globalError object in the body with the type of error.
 *
 * Most of the the time, the error includes an errorCode and an optional
 * reason property with a human readable message.
 *
 * @see https://developer.sonos.com/build/direct-control/control/
 */
class CustomException extends SonosException
{
    /**
     * @var string
     */
    protected $sonosType;

    /**
     *
     * @param string $errorMessage
     * @param string $sonosType taken from response's header X-Sonos-Type
     */
    public function __construct(string $errorMessage, string $sonosType)
    {
        parent::__construct($errorMessage);
        $this->sonosType = $sonosType;
    }

    /**
     * @return string
     */
    public function getSonosType(): string
    {
        return $this->sonosType;
    }
}