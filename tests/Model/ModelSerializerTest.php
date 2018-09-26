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

namespace Hubware\Gateway\Sonos\Test\Model;



use Hubware\Gateway\Sonos\Model\ModelSerializer;

class ModelSerializerTest extends \PHPUnit\Framework\TestCase
{
    /** @var ModelSerializer */
    private $serializer;

    protected function setUp()
    {
        parent::setUp();
        $this->serializer = new ModelSerializer();
    }

    public function testTransformHousehold()
    {
        $expected = TestFactory::getHousehold();

        $inputText = file_get_contents(__DIR__
            .'/../responses/control/households/household_single.json');
        $inputObj  = json_decode($inputText);
        $output    = $this->serializer->transformHousehold($inputObj);

        $this->assertEquals($expected, $output);
    }

    public function testTransformPlayer()
    {
        $expected = TestFactory::getPlayer();

        $inputText = file_get_contents(__DIR__
            .'/../responses/control/players/player_single.json');
        $inputObj  = json_decode($inputText);
        $output    = $this->serializer->transformPlayer($inputObj);

        $this->assertEquals($expected, $output);
    }


    public function testTransformPlayerVolume()
    {
        $expected = TestFactory::getPlayerVolume();

        $inputText = file_get_contents(__DIR__
            .'/../responses/control/players/player_playervolume.json');
        $inputObj  = json_decode($inputText);
        $output    = $this->serializer->transformPlayerVolume($inputObj);

        $this->assertEquals($expected, $output);
    }

    public function testTransformGroup()
    {
        $expected = TestFactory::getGroup();

        $inputText = file_get_contents(__DIR__
            .'/../responses/control/groups/group_single.json');
        $inputObj  = json_decode($inputText);
        $output    = $this->serializer->transformGroup($inputObj);

        $this->assertEquals($expected, $output);
    }

    public function testTransformGroupVolume()
    {
        $expected = TestFactory::getGroupVolume();

        $inputText = file_get_contents(__DIR__
            .'/../responses/control/groups/group_groupvolume.json');
        $inputObj  = json_decode($inputText);
        $output    = $this->serializer->transformGroupVolume($inputObj);

        $this->assertEquals($expected, $output);
    }

    public function testTransformGroupPlaybackStatus()
    {
        $expected = TestFactory::getGroupPlaybackStatus();

        $inputText = file_get_contents(__DIR__
            .'/../responses/control/groups/group_playbackstatus.json');
        $inputObj  = json_decode($inputText);
        $output    = $this->serializer->transformPlaybackStatus($inputObj);

        $this->assertEquals($expected, $output);
    }

}
