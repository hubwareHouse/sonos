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

namespace Hubware\Gateway\Sonos\Model\Control;

use Hubware\Gateway\Sonos\Exception\Parameter\InvalidFunctionParameter;
use Hubware\Gateway\Sonos\Exception\SonosException;
use Hubware\Gateway\Sonos\Model\Control\Players\PlayerVolume;
use Hubware\Gateway\Sonos\Model\Control\Players\SetRelativeVolume;
use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * Describes one logical speaker in a household.
 *
 * A logical speaker could be a single stand-alone device or a set of
 * bonded devices. For example, two players bonded as a stereo pair,
 * two surrounds and a SUB bonded with a PLAYBAR in a home theater setup,
 * or a player bonded with a SUB.
 *
 * Added in version 1.5.0. of the SONOS API
 *
 * @see https://developer.sonos.com/reference/control-api/groups/groups/#player
 */
class Player extends SonosBase
{

    /**
     * id of player
     *
     * @var string
     */
    public $id;

    /**
     * The display name for the player. For example, "Living Room",
     *   "Kitchen", or "Dining Room".
     *
     * @var string
     */
    public $name;

    /**
     * An identifier for the player icon.
     *
     * Set when the user chooses a pre-defined room for the player.
     * You can map this to an icon to display in your app for the player.
     * Values include any of the following:
     *   - bathroom
     *   - bedroom
     *   - den
     *   - diningroom
     *   - familyroom
     *   - foyer
     *   - garage
     *   - garden
     *   - generic
     *   - guestroom
     *   - hallway
     *   - kitchen
     *   - library
     *   - livingroom
     *   - masterbedroom
     *   - mediaroom
     *   - office
     *   - patio
     *   - playroom
     *   - pool
     *   - tvroom
     *   - portable
     *
     * Note: Sonos sends "generic" if the user set up a custom room in the
     *   Sonos app.
     *
     * @var string
     */
    public $icon;

    /**
     * The secure WebSocket URL for the device. See Connect for details.
     *
     * @var string
     */
    public $websocketUrl;

    /**
     * @var string
     */
    public $restUrl;

    /**
     * The version of the software running on the device.
     *
     * @var string
     */
    public $softwareVersion;

    /**
     * The IDs of all bonded devices corresponding to this logical player.
     *
     * @var string[]
     */
    public $deviceIds = [];

    /**
     * The highest API version supported by the player.
     *
     * @var string
     */
    public $apiVersion;

    /**
     * The lowest API version supported by the player.
     *
     * @var string
     */
    public $minApiVersion;

    /**
     * @var string[]
     */
    public $capabilities = [];

    /**
     * The player can produce audio. You can target it for playback.
     */
    const CAPABILITY_PLAYBACK = 'PLAYBACK';

    /**
     * The player can send commands and receive events over the internet.
     */
    const CAPABILITY_CLOUD = 'CLOUD';

    /**
     * The player is a home theater source. It can reproduce the audio from a
     * home theater system, typically delivered by S/PDIF or HDMI.
     */
    const CAPABILITY_HT_PLAYBACK = 'HT_PLAYBACK';

    /**
     * The player can control the home theater power state.
     *
     * For example, it can switch a connected TV on or off.
     */
    const CAPABILITY_HT_POWER_STATE = 'HT_POWER_STATE';

    /**
     * The player can host AirPlay streams.
     * This capability is present when the device is advertising AirPlay support.
     *
     * Added in version 1.5.1.
     */
    const CAPABILITY_AIRPLAY = 'AIRPLAY';

    /**
     * The player has an analog line-in.
     *
     * See Using Line-In on Sonos on the Sonos Support site for more details
     * about the line-in capabilities of our players.
     *
     * Added in version 1.6.0.
     *
     * @see https://support.sonos.com/s/article/1080#products
     */
    const CAPABILITY_LINE_IN = 'LINE_IN';

    /**
     * @var PlayerVolume
     */
    private $playerVolume = null;

    public function setVolume(int $volume) : bool
    {
        if ($volume < 0 || $volume > 100) {
            throw new InvalidFunctionParameter('Volume must be 0-100.');
        }

        $playerVolume = new PlayerVolume();
        $playerVolume->volume = $volume;
        $res = $this->getApi()->setPlayerVolume($this->id, $playerVolume);
        $this->playerVolume = null;

        return $res;
    }

    public function setVolumeRelative(int $volumeDelta)
    {
        if ($volumeDelta < -100 || $volumeDelta > 100) {
            throw new InvalidFunctionParameter('Volume delta must be between -100 and 100.');
        }
        $setRelativeVolume = new SetRelativeVolume();
        $setRelativeVolume->volumeDelta = $volumeDelta;
        $res =$this->getApi()->setPlayerVolumeRelative($this->id, $setRelativeVolume);
        $this->playerVolume = null;

        return $res;
    }

    public function getVolume() : int
    {
        return $this->getPlayerVolume()->volume;
    }

    public function setMute(bool $doMute) : bool
    {
        $playerVolume = new PlayerVolume();
        $playerVolume->muted = $doMute;
        $res = $this->getApi()->setPlayerVolume($this->id, $playerVolume);
        $this->playerVolume = null;

        return $res;
    }

    public function getIsMute() : bool
    {
        return $this->getPlayerVolume()->muted;
    }

    public function getIsFixed() : bool
    {
        return $this->getPlayerVolume()->fixed;
    }

    protected function getPlayerVolume()
    {
        if ($this->playerVolume == null)
        {
            $this->refreshPlayerVolume();
        }
        if ($this->playerVolume === null)
        {
            throw new SonosException('No player volume received for player '.$this->id);
        }
        return $this->playerVolume;
    }

    protected function refreshPlayerVolume()
    {
        $this->playerVolume = $this->getApi()->getPlayerVolume($this->id);
    }
}