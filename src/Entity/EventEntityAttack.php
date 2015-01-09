<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_entity_attack")
 */
class EventEntityAttack extends Event {

    /**
     * @OneToOne(targetEntity="LivingEntity")
     * @JoinColumn(name="attacker_living_entity_id")
     */
    private $attacker;

    /**
     * @OneToOne(targetEntity="LivingEntity")
     * @JoinColumn(name="target_living_entity_id")
     */
    private $target;

    public function __construct($adventure, LivingEntity $attacker, LivingEntity $target)
    {
        parent::__construct($adventure);
        $this->attacker = $attacker;
        $this->target = $target;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/entity_attack.php");
    }

    public static function createEventEntityAttack(Adventure $adventure, LivingEntity $attacker, LivingEntity $target)
    {
        $event = new EventEntityAttack($adventure, $attacker, $target);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    /**
     * @return mixed
     */
    public function getAttacker()
    {
        return $this->attacker;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }
}