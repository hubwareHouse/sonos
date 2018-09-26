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
use Hubware\Gateway\Sonos\Model\Control\Groups\GroupVolume;
use Hubware\Gateway\Sonos\Model\Control\Groups\PlaybackStatus;
use Hubware\Gateway\Sonos\Model\Control\Players\SetRelativeVolume;
use Hubware\Gateway\Sonos\Model\SonosBase;

/**
 * Describes one group in a household.
 *
 * consists of at least one player
 */
class Group extends SonosBase
{
    /**
     * id of group
     * @var string
     */
    public $id;

    /**
     * name of group
     * @var string
     */
    public $name;

    /**
     * id of coordinator player
     * @var string
     */
    public $coordinatorId;

    /**
     * state of playback
     * @var string
     */
    public $playbackState;

    /**
     * list of player ids that belong to this group
     * @var string[]
     */
    public $playerIds = [];

    /* VOLUME */
    /**
     * @var GroupVolume
     */
    private $groupVolume = null;

    public function setVolume(int $volume) : bool
    {
        if ($volume < 0 || $volume > 100) {
            throw new InvalidFunctionParameter('Volume must be 0-100.');
        }

        $groupVolume = new GroupVolume();
        $groupVolume->volume = $volume;
        $res = $this->getApi()->setGroupVolume($this->id, $groupVolume);
        $this->groupVolume = null;

        return $res;
    }

    public function setVolumeRelative(int $volumeDelta)
    {
        if ($volumeDelta < -100 || $volumeDelta > 100) {
            throw new InvalidFunctionParameter('Volume delta must be between -100 and 100.');
        }
        $setRelativeVolume = new SetRelativeVolume();
        $setRelativeVolume->volumeDelta = $volumeDelta;
        $res =$this->getApi()->setGroupVolumeRelative($this->id, $setRelativeVolume);
        $this->groupVolume = null;

        return $res;
    }

    public function getVolume() : int
    {
        return $this->getGroupVolume()->volume;
    }

    public function setMute(bool $doMute) : bool
    {
        $groupVolume = new GroupVolume();
        $groupVolume->muted = $doMute;
        $res = $this->getApi()->setGroupVolumeMute($this->id, $groupVolume);
        $this->groupVolume = null;

        return $res;
    }

    public function getIsMute() : bool
    {
        return $this->getGroupVolume()->muted;
    }

    public function getIsFixed() : bool
    {
        return $this->getGroupVolume()->fixed;
    }

    protected function getGroupVolume()
    {
        if ($this->groupVolume == null)
        {
            $this->refreshGroupVolume();
        }
        if ($this->groupVolume === null)
        {
            throw new SonosException('No player volume received for group '.$this->id);
        }
        return $this->groupVolume;
    }

    protected function refreshGroupVolume()
    {
        $this->groupVolume = $this->getApi()->getGroupVolume($this->id);
    }

    public function subscribeGroupVolume(bool $active = true) : bool
    {
        if ($active)
        {
            return $this->getApi()->subscribeGroupVolume($this->id);
        }
        else
        {
            return $this->getApi()->deleteSubscriptionGroupVolume($this->id);
        }
    }

    /* PLAYBACK */
    /**
     * get current playback status
     * @return PlaybackStatus
     */
    public function getPlaybackStatus() : PlaybackStatus
    {
        return $this->getApi()->getGroupPlaybackStatus($this->id);
    }

    /**
     * start playing of group
     * @return bool
     */
    public function play()
    {
        $res = $this->getApi()->setGroupPlaying($this->id);
        return true;
    }

    /**
     * pause playing of group
     * @return bool
     */
    public function pause()
    {
        $res = $this->getApi()->setGroupPause($this->id);
        return true;
    }

}