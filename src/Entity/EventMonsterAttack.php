<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_monster_attack")
 */
class EventMonsterAttack extends Event {

    /**
     * @OneToOne(targetEntity="Monster")
     */
    private $monster;

    /**
     * @OneToOne(targetEntity="AdventureCharacter")
     * @JoinColumn(name="adventure_character_id")
     */
    private $adventureCharacter;

    /**
     * @Column(type="integer")
     */
    private $damage;

    public function __construct($adventure, $monster, $adventureCharacter, $damage)
    {
        parent::__construct($adventure);
        $this->monster = $monster;
        $this->adventureCharacter = $adventureCharacter;
        $this->damage = $damage;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/monster_attack.php");
    }

    public static function createMonsterAttack(Adventure $adventure, Monster $monster, AdventureCharacter $advCharacter, $damage)
    {
        $event = new EventMonsterAttack($adventure, $monster, $advCharacter, $damage);

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

    /**
     * @return mixed
     */
    public function getAdventureCharacter()
    {
        return $this->adventureCharacter;
    }

    /**
     * @return mixed
     */
    public function getDamage()
    {
        return $this->damage;
    }
}