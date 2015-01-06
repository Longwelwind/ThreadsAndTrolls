<?php


namespace ThreadsAndTrolls\Entity;


use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="persona_statistic")
 */
class CharacterStatistic {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Character", inversedBy="statistics")
     */
    private $character;

    /**
     * @OneToOne(targetEntity="Statistic")
     */
    private $statistic;

    /**
     * @Column(type="integer")
     */
    private $amount;

    function __construct($character, $statistic, $amount)
    {
        $this->character = $character;
        $this->statistic = $statistic;
        $this->amount = $amount;
    }


    public static function getCharacterStatistic($character, $statistic)
    {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\CharacterStatistic")
                ->findOneBy(array("statistic" => $statistic, "character" => $character));
    }

    public static function createCharacterStatistic($character, $statistic) {
        $charStat = new CharacterStatistic($character, $statistic, 0);

        Database::save($charStat);

        return $charStat;
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