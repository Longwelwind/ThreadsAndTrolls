<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_monster_spawn")
 */
class EventMonsterSpawn extends Event {


    /**
     * @OneToOne(targetEntity="Monster")
     */
    private $monster;

    public function __construct($adventure, $monster)
    {
        parent::__construct($adventure);
        $this->monster = $monster;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/monster_spawn.php");
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