<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;
use ThreadsAndTrolls\DiceRoll;

/**
 * @Entity
 * @Table(name="adventure_character")
 */
class AdventureCharacter extends LivingEntity {

    /**
     * @OneToOne(targetEntity="Character")
     */
    private $character;

    public function __construct($character, $adventure, $health) {
        parent::__construct($adventure, $health);

        $this->character = $character;
    }

    public function useAbility(Ability $ability, $arguments)
    {
        EventCharacterUseAbility::createEventCharacterUseAbility($this->getAdventure(), $this, $ability);
        $ability->onCast($this->getAdventure(), $this, $arguments);
    }

    public function testStatistic(Statistic $statisticToCheck, DiceRoll $diceRoll, $requiredAmount) {

        $resultRoll = $diceRoll->randomResult();
        $statisticAmount = $this->getStatisticAmount($statisticToCheck);

        EventStatisticTest::createEventStatisticTest($this->getAdventure(), $this, $statisticToCheck,
            $diceRoll->getCountDice(), $diceRoll->getCountDiceSide(), $resultRoll, $requiredAmount, $statisticAmount);

        return ($resultRoll + $statisticAmount >= $requiredAmount);
    }

    public function getStatisticAmount($statistic) {
        return $this->getCharacter()->getStatisticAmount($statistic);
    }

    public static function joinAdventure(Character $character, Adventure $adventure) {

        $adventureCharacter = new AdventureCharacter($character, $adventure, $character->getMaxHealth());

        $adventure->getCharacters()->add($adventureCharacter);

        Database::getEntityManager()->persist($adventureCharacter);
        Database::getEntityManager()->flush();

        return $adventureCharacter;

    }

    public static function getAdventureCharacter(Character $character, Adventure $adventure) {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\AdventureCharacter")
                ->findOneBy(array("character" => $character, "adventure" => $adventure));
    }

    public function getAttackDamage() {
        return $this->getCharacter()->getAttackDamage();
    }

    public function getName() {
        return $this->getCharacter()->getName();
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }

    public function getMaxHealth() {
        return $this->getCharacter()->getMaxHealth();
    }
} 