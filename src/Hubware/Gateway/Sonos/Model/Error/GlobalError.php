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

namespace Hubware\Gateway\Sonos\Model\Error;


/**
 * Players use the globalError object type for command responses that include
 * generic errors that apply to commands in all namespaces in the Control API.
 * Players send an errorCode and reason in the body, as well as a success value
 * of false in the response header. The errorCode values are listed and
 * described below.
 *
 */
class GlobalError
{
    /**
     * @var string
     */
    public $errorCode;

    /**
     * (optional)
     * The reason values are readable strings that describe syntax and parameter
     * errors. These strings are not intended for end-user display or for use
     * programmatically. If your app receives one of these error responses,
     * you may be able to debug the error as described below.
     *
     * @var string|null
     */
    public $reason;
}