<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="monster")
 */
class Monster extends LivingEntity {

    /**
     * @OneToOne(targetEntity="MonsterModel")
     * @JoinColumn(name="monster_model_id", referencedColumnName="id")
     */
    private $monsterModel;

    public function __construct(MonsterModel $monsterModel, Adventure $adventure, $health) {
        parent::__construct($adventure, $health);

        $this->monsterModel = $monsterModel;
    }

    public function getAttackDamage()
    {
        return $this->getMonsterModel()->getAttackDamage();
    }


    public static function createMonster(MonsterModel $monsterModel, Adventure $adventure) {

        $monster = new Monster($monsterModel, $adventure, $monsterModel->getMaxHealth());

        $adventure->getMonsters()->add($monster);

        Database::save($monster);

        return $monster;
    }

    public function isDead() {
        return ($this->getHealth() == 0);
    }

    public static function getMonster($id) {
        return Database::getEntityManager()->find("ThreadsAndTrolls\\Entity\\Monster", $id);
    }

    /**
     * @return mixed
     */
    public function getMonsterModel()
    {
        return $this->monsterModel;
    }

    public function getName() {
        return $this->getMonsterModel()->getName();
    }

    public function getMaxHealth() {
        return $this->getMonsterModel()->getMaxHealth();
    }


} 