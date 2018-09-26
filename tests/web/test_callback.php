<?php
require_once __DIR__.'/__config.php';

$sonosApiEndpoint = new \Hubware\Gateway\Sonos\SonosApiEndpoint();
$sonosApiEndpoint->setAccessToken($accessToken);

/** @var \Hubware\Gateway\Sonos\Model\Control\Household $household */
$household = $sonosApiEndpoint->getHouseholds()[0];

$player = $household->getPlayerByName('Büro');
$group = $household->getGroupByName('Büro');


// register callback from SONOS
$res = $group->subscribeGroupVolume(false);
var_dump($res);

// deregister
$res = $group->subscribeGroupVolume(false);
var_dump($res);

// all callback from SONOS Cloud go the event callback url, as configured in the control
// use __api_receiver.php to test + debug this
