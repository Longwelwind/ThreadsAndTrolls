<?php

namespace ThreadsAndTrolls\Entity\Event;
use ThreadsAndTrolls\Entity\Adventure;
use ThreadsAndTrolls\Entity\LivingEntity;
use ThreadsAndTrolls\Entity\Effect;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_entity_finish_effect")
 */
class EventEntitySufferEffect extends Event {

    /**
     * @OneToOne(targetEntity="ThreadsAndTrolls\Entity\Effect")
     * @JoinColumn(name="effect_id")
     */
    private $effect;

    /**
     * @OneToOne(targetEntity="ThreadsAndTrolls\Entity\LivingEntity")
     * @JoinColumn(name="living_entity_id")
     */
    private $livingEntity;

    function __construct($adventure, $livingEntity, $effect)
    {
        parent::__construct($adventure);
        $this->effect = $effect;
        $this->livingEntity = $livingEntity;
    }

    public function displayRow() {
        include(self::getViewsPath() . "entity_suffer_effect.php");
    }

    public static function createEventEntitySufferEffect(Adventure $adventure, LivingEntity $livingEntity, Effect $effect)
    {
        $event = new EventEntitySufferEffect($adventure, $livingEntity, $effect);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    /**
     * @return mixed
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * @return mixed
     */
    public function getLivingEntity()
    {
        return $this->livingEntity;
    }
}