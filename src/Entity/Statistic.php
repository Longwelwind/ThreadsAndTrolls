<?php


namespace ThreadsAndTrolls\Entity;


use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="statistic")
 */
class Statistic {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(length=255)
     */
    private $name;

    /**
     * @Column(length=255)
     */
    private $tag;

    const STRENGTH = 1;
    const INTELLIGENCE = 2;
    const DEXTERITY = 3;

    public static function getStatistic($id) {
        return Database::getEntityManager()->find("ThreadsAndTrolls\\Entity\\Statistic", $id);
    }

    public static function getStatisticByTag($tag) {
        return Database::getRepository("ThreadsAndTrolls\\Entity\\Statistic")
            ->findOneBy(array("tag" => $tag));
    }

    public static function getAllStatistics() {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\Statistic")->findAll();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }
} 