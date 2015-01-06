<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="race")
 */
class Race {

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
     * @Column(length=255)
     */
    private $tag;

    /**
     * @OneToMany(targetEntity="RaceStatistic", mappedBy="race")
     */
    private $statistics;

    /**
     * @Column(type="integer")
     */
    private $max_health;

    public function getStatistic(Statistic $statistic) {
        $raceStat = RaceStatistic::getRaceStatistic($this, $statistic);

        return $raceStat->getAmount();
    }

    public static function getRaceByTag($tag) {
        return Database::getRepository("ThreadsAndTrolls\\Entity\\Race")
            ->findOneBy(array("tag" => $tag));
    }

    public static function find($id) {
        return Database::getEntityManager()->find("ThreadsAndTrolls\\Entity\\Race", $id);
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


} 