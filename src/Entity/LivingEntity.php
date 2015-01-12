<?php


namespace ThreadsAndTrolls\Entity;

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

    function __construct($adventure, $health)
    {
        $this->adventure = $adventure;
        $this->health = $health;
    }

    public abstract function getAttackDamage();
    public abstract function getName();
    public abstract function getMaxHealth();

    public function attack(LivingEntity $target) {
        $damage = $this->getAttackDamage();

        EventEntityAttack::createEventEntityAttack($this->getAdventure(), $this, $target);
        $finalDamage = $this->inflictDamage($target, $damage);

        return $finalDamage;
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
} 