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

namespace Hubware\Gateway\Sonos\Model;


use Hubware\Gateway\Sonos\ApiRestCommunicationHandler;

/**
 * base class for all model classes
 *
 * holds connection to api so the subclasses can invoke the necessary calls
 * directly
 *
 * @package Hubware\Gateway\Sonos\Model
 */
class SonosBase
{
    /** @var ApiRestCommunicationHandler */
    private $api;

    protected function call(string $apiMessage, $method =  ApiRestCommunicationHandler::METHOD_GET, $body = null)
    {
        return $this->api->call($apiMessage, $method, $body);
    }


    public function setApi(ApiRestCommunicationHandler $api)
    {
        $this->api = $api;
    }

    protected function getApi() : ApiRestCommunicationHandler
    {
        return $this->api;
    }


}