<?php


namespace ThreadsAndTrolls;


class DiceRoll {

    private $countDiceSide;
    private $countDice;

    function __construct($countDice, $countDiceSide)
    {
        $this->countDice = $countDice;
        $this->countDiceSide = $countDiceSide;
    }

    public function randomResult() {
        $amount = 0;
        for ($i = 0;$i < $this->countDice;$i++) {

            $roll = mt_rand(1, $this->countDiceSide);
            $amount += $roll;

        }

        return $amount;
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