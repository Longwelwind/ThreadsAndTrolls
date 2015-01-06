<?php


namespace ThreadsAndTrolls\Entity;

use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_reward_experience")
 */
class EventRewardExperience extends Event {
    /**
     * @OneToOne(targetEntity="Character")
     */
    private $character;

    /**
     * @Column(type="integer")
     */
    private $experience;

    function __construct($adventure, $character, $experience)
    {
        parent::__construct($adventure);

        $this->character = $character;
        $this->experience = $experience;
    }

    public static function createEventRewardExperience($adventure, $character, $experience)
    {
        $event = new EventRewardExperience($adventure, $character, $experience);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/rewardexperience.php");
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }
} 