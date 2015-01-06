<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="monster_model")
 */
class MonsterModel {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(length=255)
     */
    private $name;

    /**
     * @Column(type="integer")
     */
    private $max_health;

    /**
     * @Column(type="integer", name="attack_damage")
     */
    private $attackDamage;

    public static function getMonsterModel($id) {
        return Database::getEntityManager()->find("ThreadsAndTrolls\\Entity\\MonsterModel", $id);
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
    public function getMaxHealth()
    {
        return $this->max_health;
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
    public function getAttackDamage()
    {
        return $this->attackDamage;
    }


}