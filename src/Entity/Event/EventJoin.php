<?php


namespace ThreadsAndTrolls\Entity\Event;
use ThreadsAndTrolls\Database;
use ThreadsAndTrolls\Entity\Adventure;

/**
 * @Entity
 * @Table(name="event_join")
 */
class EventJoin extends Event {

    /**
     * @OneToOne(targetEntity="ThreadsAndTrolls\Entity\Character")
     */
    private $character;

    public function __construct($adventure, $character)
    {
        parent::__construct($adventure);
        $this->character = $character;
    }

    public function displayRow() {
        include(self::getViewsPath() . "/../../views/event/join.php");
    }

    public static function createEventJoin(Adventure $adventure, $character)
    {
        $event = new EventJoin($adventure, $character);
        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }



} 