<?php


namespace ThreadsAndTrolls\Entity;


class LivingEntity {
    /**
     * @Column(type="integer")
     */
    protected $health;

    public function damage($damage) {
        $this->setHealth($this->getHealth() - $damage);
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
        }

        $this->health = $health;
    }
} 