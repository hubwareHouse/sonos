<?php
require_once __DIR__.'/__config.php';



$sonosApiEndpoint = new \Hubware\Gateway\Sonos\SonosApiEndpoint();
$sonosApiEndpoint->setAccessToken($accessToken);


$households = $sonosApiEndpoint->getHouseholds();
/** @var \Hubware\Gateway\Sonos\Model\Control\Household $household */
foreach($households as $household)
{

    $player = $household->getPlayerByName($playerName);

    $group = $household->getGroupByName($groupName);

    if ($player == null || $group == null) continue;

    $group->play();
    dumpGroup($group);
    dumpPlayer($player);
    sleep(5);

    $player->setMute(true);
    dumpPlayer($player);
    sleep(5);

    $player->setMute(false);
    dumpPlayer($player);
    sleep(5);

    $player->setVolume(rand(1,10));
    dumpPlayer($player);
    sleep(5);

    $player->setVolumeRelative(rand(-10,10));
    dumpPlayer($player);
    sleep(5);

    $group->setVolume(5);
    dumpGroup($group);
    sleep(5);

    $group->setMute(true);
    dumpGroup($group);
    sleep(5);

    $group->setMute(false);
    dumpGroup($group);
    sleep(5);

    $group->setVolumeRelative(5);
    dumpGroup($group);
    sleep(5);


    $group->pause();
}