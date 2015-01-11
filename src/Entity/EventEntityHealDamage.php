<?php


namespace ThreadsAndTrolls\Entity;

use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_entity_heal_damage")
 */
class EventEntityHealDamage extends Event {
    /**
     * @OneToOne(targetEntity="LivingEntity")
     * @JoinColumn(name="healer_living_entity_id")
     */
    private $healer;

    /**
     * @OneToOne(targetEntity="LivingEntity")
     * @JoinColumn(name="target_living_entity_id")
     */
    private $target;

    /**
     * @Column(type="integer")
     */
    private $damage;

    public function __construct($adventure, LivingEntity $healer, LivingEntity $target, $damage)
    {
        parent::__construct($adventure);
        $this->healer = $healer;
        $this->target = $target;
        $this->damage = $damage;
    }

    public function displayRow()
    {
        include(__DIR__ . "/../../views/event/entity_heal_damage.php");
    }

    public static function createEventEntityHealDamage(Adventure $adventure, LivingEntity $healer, LivingEntity $target, $damage)
    {
        $event = new EventEntityHealDamage($adventure, $healer, $target, $damage);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    /**
     * @return mixed
     */
    public function getHealer()
    {
        return $this->healer;
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