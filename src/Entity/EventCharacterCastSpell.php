<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_character_cast_spell")
 */
class EventCharacterCastSpell extends Event {

    /**
     * @OneToOne(targetEntity="Spell")
     */
    private $spell;

    /**
     * @OneToOne(targetEntity="AdventureCharacter")
     * @JoinColumn(name="adventure_character_id")
     */
    private $adventureCharacter;

    function __construct($adventure, $adventureCharacter, $spell)
    {
        parent::__construct($adventure);
        $this->adventureCharacter = $adventureCharacter;
        $this->spell = $spell;
    }


    public function displayRow() {

        include(__DIR__ . "/../../views/event/character_cast_spell.php");
    }

    public static function createEventCharacterCastSpell($adventure, $adventureCharacter, $spell) {

        $event = new EventCharacterCastSpell($adventure, $adventureCharacter, $spell);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;

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
    public function getSpell()
    {
        return $this->spell;
    }


} 