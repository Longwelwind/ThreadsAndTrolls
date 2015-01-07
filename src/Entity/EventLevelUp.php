<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_level_up")
 */
class EventLevelUp extends Event {

    /**
     * @OneToOne(targetEntity="Character")
     */
    private $character;

    /**
     * @Column(type="integer")
     */
    private $level;

    function __construct($adventure, $character, $level)
    {
        parent::__construct($adventure);

        $this->character = $character;
        $this->level = $level;
    }

    public static function createEventLevelUp($adventure, $character, $level)
    {
        $event = new EventLevelUp($adventure, $character, $level);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/level_up.php");
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
    public function getLevel()
    {
        return $this->level;
    }
} 