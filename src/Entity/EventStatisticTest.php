<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="event_statistic_test")
 */
class EventStatisticTest extends Event {

    /**
     * @OneToOne(targetEntity="AdventureCharacter")
     * @JoinColumn(name="adventure_character_id")
     */
    private $adventureCharacter;

    /**
     * @OneToOne(targetEntity="Statistic")
     */
    private $statistic;

    /**
     * @Column(type="integer", name="statistic_amount")
     */
    private $statisticAmount;

    /**
     * @Column(type="integer", name="count_dice")
     */
    private $countDice;

    /**
     * @Column(type="integer", name="count_dice_side")
     */
    private $countDiceSide;

    /**
     * @Column(type="integer", name="roll_dice_result")
     */
    private $rollDiceResult;

    /**
     * @Column(type="integer", name="required_amount")
     */
    private $requiredAmount;

    function __construct($adventure, $adventureCharacter, $statistic, $requiredAmount,
                         $countDice, $countDiceSide, $rollDiceResult, $statisticAmount)
    {
        parent::__construct($adventure);

        $this->adventureCharacter = $adventureCharacter;
        $this->requiredAmount = $requiredAmount;
        $this->countDice = $countDice;
        $this->countDiceSide = $countDiceSide;
        $this->rollDiceResult = $rollDiceResult;
        $this->statistic = $statistic;
        $this->statisticAmount = $statisticAmount;
    }


    public static function createEventStatisticTest($adventure, $adventureCharacter, $statistic, $countDice,
                                                    $countDiceSide, $rollDiceResult, $requiredAmount, $statisticAmount)
    {
        $event = new EventStatisticTest($adventure, $adventureCharacter, $statistic, $requiredAmount,
                                            $countDice, $countDiceSide, $rollDiceResult, $statisticAmount);

        $adventure->getEvents()->add($event);

        Database::save($event);

        return $event;
    }

    public function displayRow() {

        include(__DIR__ . "/../../views/event/statistic_test.php");
    }

    public function isSuccessful() {
        return ($this->getTotalAmount() >= $this->getRequiredAmount());
    }

    public function getTotalAmount() {
        return $this->getStatisticAmount() + $this->getRollDiceResult();
    }

    /**
     * @return mixed
     */
    public function getAdventureCharacter()
    {
        return $this->adventureCharacter;
    }

    /**
     * @return mixed
     */
    public function getRequiredAmount()
    {
        return $this->requiredAmount;
    }

    /**
     * @return mixed
     */
    public function getRollDiceResult()
    {
        return $this->rollDiceResult;
    }

    /**
     * @return mixed
     */
    public function getStatisticAmount()
    {
        return $this->statisticAmount;
    }

    /**
     * @return mixed
     */
    public function getStatistic()
    {
        return $this->statistic;
    }

    /**
     * @return mixed
     */
    public function getCountDice()
    {
        return $this->countDice;
    }

    /**
     * @return mixed
     */
    public function getCountDiceSide()
    {
        return $this->countDiceSide;
    }
} 