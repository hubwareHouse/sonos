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

namespace Hubware\Gateway\Sonos;

/**
 * Class SonosApiEndpoint
 *
 * @package Hubware\Gateway\Sonos
 */
class SonosApiEndpoint
{
    /**
     * @var ApiRestCommunicationHandler
     */
    private $api;

    /**
     */
    public function __construct()
    {
        $this->api = new ApiRestCommunicationHandler();
    }

    public function setAccessToken($accessToken)
    {
        $this->api->setAccessToken($accessToken);
    }

    public function getHouseholds()
    {
        return $this->api->getHouseholds();
    }
}