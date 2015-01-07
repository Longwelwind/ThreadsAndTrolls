<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_character_attack")
 */
class EventCharacterAttack extends Event {
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

    public function __construct($adventure, $adventureCharacter, $monster, $damage)
    {
        parent::__construct($adventure);
        $this->adventureCharacter = $adventureCharacter;
        $this->monster = $monster;
        $this->damage = $damage;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/character_attack.php");
    }

    public static function createCharacterAttack(Adventure $adventure, AdventureCharacter $adventureCharacter, Monster $monster, $damage)
    {
        $event = new EventCharacterAttack($adventure, $adventureCharacter, $monster, $damage);

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