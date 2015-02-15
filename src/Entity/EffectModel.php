<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Action\ActionEntityAction;
use ThreadsAndTrolls\Action\ActionEntityAttack;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="effect_model")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="effect_type", type="string")
 */
abstract class EffectModel {

    /**
     * @Id
     * @GeneratedColumn
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(length=255)
     */
    private $name;

    /**
     * @Column(type="text")
     */
    private $description;

    /**
     * @Column(length=255)
     */
    private $icon;

    abstract function getDuration(Effect $effect);

    public function remove(Effect $effect) {
        $effect->remove();
    }

    /*
     * All those events can be overriden by a child object
     */

    public function onEntityStatGet(ActionEntityAction $action, Effect $effect) { }

    public function onEntityAttack(ActionEntityAttack $action, Effect $effect) { }

    public function onEntityUseAbility(ActionEntityAction $action, Effect $effect) { }

    public function onEntityDamage(ActionEntityAction $action, Effect $effect) { }

    public function onEntityHeal(ActionEntityAction $action, Effect $effect) { }

    public function onEntityAction(ActionEntityAction $action, Effect $effect) { }

    /*
     * End of events
     */

    public static function find($id) {
        return Database::getRepository(self::class)->find($id);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

} 