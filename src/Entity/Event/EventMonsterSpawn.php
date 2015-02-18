<?php


namespace ThreadsAndTrolls\Entity\Event;
use ThreadsAndTrolls\Database;
use ThreadsAndTrolls\Entity\Adventure;
use ThreadsAndTrolls\Entity\Monster;

/**
 * @Entity
 * @Table(name="event_monster_spawn")
 */
class EventMonsterSpawn extends Event {


    /**
     * @OneToOne(targetEntity="ThreadsAndTrolls\Entity\Monster")
     */
    private $monster;

    public function __construct($adventure, $monster)
    {
        parent::__construct($adventure);
        $this->monster = $monster;
    }

    public function displayRow() {

        include(self::getViewsPath() . "/../../views/event/monster_spawn.php");
    }

    public static function createMonsterSpawn(Adventure $adventure, Monster $monster)
    {
        $event = new EventMonsterSpawn($adventure, $monster);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    /**
     * @return mixed
     */
    public function getMonster()
    {
        return $this->monster;
    }


} 