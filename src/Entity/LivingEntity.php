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

    public function inflictDamage(LivingEntity $target, $damage, $damageType = 0) {
        EventEntityInflictDamage::createEventEntityInflictDamage($this->getAdventure(), $this, $target, $damage);
        $finalDamage = $target->damage($damage);

        return $finalDamage;
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