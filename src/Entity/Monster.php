<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="monster")
 */
class Monster extends LivingEntity {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @OneToOne(targetEntity="MonsterModel")
     * @JoinColumn(name="monster_model_id", referencedColumnName="id")
     */
    private $monsterModel;

    /**
     * @ManyToOne(targetEntity="Adventure", inversedBy="monsters")
     */
    private $adventure;

    public function __construct(MonsterModel $monsterModel, Adventure $adventure, $health) {
        $this->monsterModel = $monsterModel;
        $this->adventure = $adventure;
        $this->health = $health;
    }

    public function attack($target) {
        $damage = $this->getMonsterModel()->getAttackDamage();

        $target->damage($damage);

        return $damage;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName() {
        return $this->getMonsterModel()->getName();
    }

    public function getMaxHealth() {
        return $this->getMonsterModel()->getMaxHealth();
    }


} 