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

    public function __construct($adventure, $adventureCharacter, $monster)
    {
        parent::__construct($adventure);
        $this->adventureCharacter = $adventureCharacter;
        $this->monster = $monster;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/character_attack.php");
    }

    public static function createEventCharacterAttack(Adventure $adventure, AdventureCharacter $adventureCharacter, Monster $monster)
    {
        $event = new EventCharacterAttack($adventure, $adventureCharacter, $monster);

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
} 