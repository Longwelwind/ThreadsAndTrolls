<?php


namespace ThreadsAndTrolls\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use ThreadsAndTrolls\Action\Action;
use ThreadsAndTrolls\Action\ActionEntityAction;
use ThreadsAndTrolls\Action\ActionEntityAttack;
use ThreadsAndTrolls\Action\ActionEntityDamage;
use ThreadsAndTrolls\Action\ActionEntityHeal;
use ThreadsAndTrolls\Action\ActionEntityStatGet;
use ThreadsAndTrolls\Action\ActionEntityUseAbility;

/**
 * @Entity
 * @Table(name="living_entity")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="living_entity_type", type="string")
 */
abstract class LivingEntity {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Adventure", inversedBy="monsters")
     */
    private $adventure;

    /**
     * @Column(type="integer")
     */
    private $health;

    /**
     * @OneToMany(targetEntity="Effect", mappedBy="bearer")
     */
    private $effects;

    function __construct($adventure, $health)
    {
        $this->adventure = $adventure;
        $this->health = $health;

        $this->effects = new ArrayCollection();
    }

    public abstract function getAttackDamage();
    public abstract function getName();
    public abstract function getMaxHealth();

    public function attack(LivingEntity $target) {
        $baseDamage = $this->getAttackDamage();

        // We trigger the action
        $action = new ActionEntityAttack($target, $this, $baseDamage, Action::BEFORE);
        $this->adventure->onEntityAttack($action);

        if ($action->isCancelled()) {
            // The attack has been cancelled
            return 0;
        }

        $transitionDamage = $action->getFinalDamage();

        EventEntityAttack::createEventEntityAttack($this->getAdventure(), $this, $target);
        $finalDamage = $this->inflictDamage($target, $transitionDamage);

        // We trigger the AFTER action
        $action->proceed();
        $this->adventure->onEntityAttack($action);

        return $finalDamage;
    }

    public function addEffect(LivingEntity $origin, EffectModel $model, $data) {
        // We must first check if an effect from the same origin and with the same model
        // TODO: check that

        $effect = Effect::createEffect($origin, $this, $model, $data);

        $this->effects->add($effect);

        return $effect;
    }

    public function removeEffect(Effect $effect) {
        return $this->effects->removeElement($effect);
    }

    public function damage($damage)
    {
        $this->setHealth($this->getHealth() - $damage);

        return $damage;
    }

    public function heal($damage) {
        $this->setHealth($this->getHealth() + $damage);

        return $damage;
    }

    public function inflictDamage(LivingEntity $target, $damage, $damageType = 0) {
        EventEntityInflictDamage::createEventEntityInflictDamage($this->getAdventure(), $this, $target, $damage);
        $finalDamage = $target->damage($damage);

        return $finalDamage;
    }

    public function healDamage(LivingEntity $target, $damage) {
        EventEntityHealDamage::createEventEntityHealDamage($this->getAdventure(), $this, $target, $damage);
        $finalDamage = $target->heal($damage);

        return $finalDamage;
    }

    public function getPercentageHealth() {
        $health = $this->getHealth();
        $maxHealth = $this->getMaxHealth();

        if ($maxHealth == 0)
            return 0;

        return 100*($health/$maxHealth);
    }

    /*
     * ActionListener stuff
     */

    public function onEntityStatGet(ActionEntityStatGet $action) {
        foreach ($this->getEffects() as $effect) {
            $effect->onEntityAttack($action);
        }
    }

    public function onEntityAttack(ActionEntityAttack $action) {

        foreach ($this->getEffects() as $effect) {
            $effect->onEntityAttack($action);
        }
    }

    public function onEntityUseAbility(ActionEntityUseAbility $action) {
        foreach ($this->getEffects() as $effect) {
            $effect->onEntityUseAbility($action);
        }
    }

    public function onEntityDamage(ActionEntityDamage $action) {
        foreach ($this->getEffects() as $effect) {
            $effect->onEntityDamage($action);
        }
    }

    public function onEntityHeal(ActionEntityHeal $action) {
        foreach ($this->getEffects() as $effect) {
            $effect->onEntityHeal($action);
        }
    }

    public function onEntityAction(ActionEntityAction $action) {
        foreach ($this->getEffects() as $effect) {
            $effect->onEntityAction($action);
        }
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth($health)
    {
        if ($health < 0) {
            $health = 0;
        } else if ($health > $this->getMaxHealth()) {
            $health = $this->getMaxHealth();
        }

        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getAdventure()
    {
        return $this->adventure;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEffects()
    {
        return $this->effects->toArray();
    }
} 