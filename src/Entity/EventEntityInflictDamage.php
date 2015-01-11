<?php


namespace ThreadsAndTrolls\Entity;

use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_entity_inflict_damage")
 */
class EventEntityInflictDamage extends Event {
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

    /**
     * @Column(type="integer")
     */
    private $damage;

    public function __construct($adventure, LivingEntity $attacker, LivingEntity $target, $damage)
    {
        parent::__construct($adventure);
        $this->attacker = $attacker;
        $this->target = $target;
        $this->damage = $damage;
    }

    public function displayRow()
    {
        include(__DIR__ . "/../../views/event/entity_inflict_damage.php");
    }

    public static function createEventEntityInflictDamage(Adventure $adventure, LivingEntity $attacker, LivingEntity $target, $damage)
    {
        $event = new EventEntityInflictDamage($adventure, $attacker, $target, $damage);

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
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }
} 