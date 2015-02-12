<?php

namespace ThreadsAndTrolls\Action;

use ThreadsAndTrolls\Entity\LivingEntity;

class ActionEntityAttack extends ActionEntityAction {

    private $target;
    private $baseDamage;
    private $finalDamage;

    function __construct(LivingEntity $target, LivingEntity $attacker, $baseDamage, $time)
    {
        parent::__construct($attacker, $time);
        $this->target = $target;
        $this->baseDamage = $baseDamage;
        $this->finalDamage = $baseDamage;
    }

    /**
     * @return mixed
     */
    public function getFinalDamage()
    {
        return $this->finalDamage;
    }

    /**
     * @param mixed $finalDamage
     */
    public function setFinalDamage($finalDamage)
    {
        if ($this->getTime() == Action::AFTER) {
            return;
        }

        $this->finalDamage = $finalDamage;
    }

    /**
     * @return LivingEntity
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param LivingEntity $target
     */
    public function setTarget($target)
    {
        if ($this->getTime() == Action::AFTER) {
            return;
        }

        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getBaseDamage()
    {
        return $this->baseDamage;
    }
}