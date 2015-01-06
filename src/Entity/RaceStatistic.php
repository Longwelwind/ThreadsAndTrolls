<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="race_statistic")
 */
class RaceStatistic {
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Race", inversedBy="statistics")
     */
    private $race;

    /**
     * @OneToOne(targetEntity="Statistic")
     */
    private $statistic;

    /**
     * @Column(type="integer")
     */
    private $amount;

    function __construct($race, $statistic, $amount)
    {
        $this->race = $race;
        $this->statistic = $statistic;
        $this->amount = $amount;
    }


    public static function getRaceStatistic($race, $statistic)
    {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\RaceStatistic")
            ->findOneBy(array("statistic" => $statistic, "race" => $race));
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        if ($amount < 0) {
            $amount = 0;
        }
        $this->amount = $amount;
    }
} 