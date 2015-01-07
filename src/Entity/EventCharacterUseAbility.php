<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_character_use_ability")
 */
class EventCharacterUseAbility extends Event {

    /**
     * @OneToOne(targetEntity="Ability")
     */
    private $ability;

    /**
     * @OneToOne(targetEntity="AdventureCharacter")
     * @JoinColumn(name="adventure_character_id")
     */
    private $adventureCharacter;

    function __construct($adventure, $adventureCharacter, $ability)
    {
        parent::__construct($adventure);
        $this->adventureCharacter = $adventureCharacter;
        $this->ability = $ability;
    }


    public function displayRow() {

        include(__DIR__ . "/../../views/event/character_use_ability.php");
    }

    public static function createEventCharacterUseAbility($adventure, $adventureCharacter, $ability) {

        $event = new EventCharacterUseAbility($adventure, $adventureCharacter, $ability);

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
    public function getAbility()
    {
        return $this->ability;
    }


} 