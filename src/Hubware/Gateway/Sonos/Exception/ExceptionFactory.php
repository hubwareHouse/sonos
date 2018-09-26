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


use Hubware\Gateway\Sonos\Exception\Custom\CommandFailedException;
use Hubware\Gateway\Sonos\Exception\Custom\CustomException;
use Hubware\Gateway\Sonos\Exception\Custom\InvalidObjectIdException;
use Hubware\Gateway\Sonos\Exception\Custom\InvalidParameterException;
use Hubware\Gateway\Sonos\Exception\Custom\InvalidSyntaxException;
use Hubware\Gateway\Sonos\Exception\Custom\MissingParametersException;
use Hubware\Gateway\Sonos\Exception\Custom\UnsupportedCommandException;
use Hubware\Gateway\Sonos\Exception\Custom\UnsupportedNamespaceException;
use Hubware\Gateway\Sonos\Model\Error\GlobalError;

/**
 * factor friendly exceptions
 *
 *
 */
class ExceptionFactory
{
    /**
     * validate and return the appropriate exception
     *
     *
     * @param GlobalError $globalError
     * @param string      $sonosErrorType
     *
     * @return CustomException
     */
    public static function handleCustomException(GlobalError $globalError, string $sonosErrorType) : CustomException
    {
        $result = null;
        switch ($globalError->errorCode)
        {
            case CommandFailedException::ERROR_CODE:
                $result = new CommandFailedException($globalError->reason, $sonosErrorType);
                break;
            case InvalidObjectIdException::ERROR_CODE:
                $result = new InvalidObjectIdException($globalError->reason, $sonosErrorType);
                break;
            case InvalidParameterException::ERROR_CODE:
                $result = new InvalidParameterException($globalError->reason, $sonosErrorType);
                break;
            case InvalidSyntaxException::ERROR_CODE:
                $result = new InvalidSyntaxException($globalError->reason, $sonosErrorType);
                break;
            case MissingParametersException::ERROR_CODE:
                $result = new MissingParametersException($globalError->reason, $sonosErrorType);
                break;
            case UnsupportedCommandException::ERROR_CODE:
                $result = new UnsupportedCommandException($globalError->reason, $sonosErrorType);
                break;
            case UnsupportedNamespaceException::ERROR_CODE:
                $result = new UnsupportedNamespaceException($globalError->reason, $sonosErrorType);
                break;

            // new error code - not yet written on the API doc
            default:
                $msg = 'Error code: '. $globalError->errorCode. ', reason: '.$globalError->reason;
                $result = new CustomException($msg, $sonosErrorType);
                break;
        }

        return $result;
    }

}