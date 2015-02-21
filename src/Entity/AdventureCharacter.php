<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;
use ThreadsAndTrolls\DiceRoll;
use ThreadsAndTrolls\Entity\Ability\Ability;
use ThreadsAndTrolls\Entity\Event\EventCharacterUseAbility;
use ThreadsAndTrolls\Entity\Event\EventStatisticTest;

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

    /**
     * Make the character use the ability $ability with the arguments $arguments
     * @param Ability $ability Used ability
     * @param mixed[] $arguments The array of argument returned by $ability->processArguments()
     */
    public function useAbility(Ability $ability, $arguments)
    {
        EventCharacterUseAbility::createEventCharacterUseAbility($this->getAdventure(), $this, $ability);
        $ability->onCast($this->getAdventure(), $this, $arguments);
    }

    /**
     * Make a statistic test
     * Will create an EventStatisticTest
     * @param Statistic $statisticToCheck The statistic to test
     * @param DiceRoll $diceRoll A DiceRoll object that will generate a random roll
     * @param $requiredAmount Required total amount to succeed.
     * @return bool Wether the test succeed or failed.
     */
    public function testStatistic(Statistic $statisticToCheck, DiceRoll $diceRoll, $requiredAmount) {

        $resultRoll = $diceRoll->randomResult();
        $statisticAmount = $this->getStatisticAmount($statisticToCheck);

        EventStatisticTest::createEventStatisticTest($this->getAdventure(), $this, $statisticToCheck,
            $diceRoll->getCountDice(), $diceRoll->getCountDiceSide(), $resultRoll, $requiredAmount, $statisticAmount);

        return ($resultRoll + $statisticAmount >= $requiredAmount);
    }

    /**
     * Returns the amount of points in one statistic for the Character
     * @param Statitic|int $statistic The Statistic object (or the ID of it) to get amount of point of.
     * @return int The amount of points this character has for this statistic
     */
    public function getStatisticAmount($statistic) {
        return $this->getCharacter()->getStatisticAmount($statistic);
    }

    /**
     * Make the character $character join the adventure $adventure
     * Doesn't check if the character is already in a adventure
     * @param Character $character The Character who joins the adventure
     * @param Adventure $adventure The Adventure to join
     * @return AdventureCharacter The AdventureCharacter object that result from the join
     */
    public static function joinAdventure(Character $character, Adventure $adventure) {

        $adventureCharacter = new AdventureCharacter($character, $adventure, $character->getMaxHealth());

        $adventure->getCharacters()->add($adventureCharacter);

        Database::getEntityManager()->persist($adventureCharacter);
        Database::getEntityManager()->flush();

        return $adventureCharacter;
    }

    /**
     * Returns the AdventureCharacter from $character and $adventure.
     * May be used to check if a character is in an adventure or not
     * @param Character $character
     * @param Adventure $adventure
     * @return AdventureCharacter|null The AdventureCharacter object, null if the character isn't in the adventure
     */
    public static function getAdventureCharacter(Character $character, Adventure $adventure) {
        return Database::getEntityManager()->getRepository(self::class)
                ->findOneBy(array("character" => $character, "adventure" => $adventure));
    }

    /**
     * @return int
     */
    public function getAttackDamage() {
        return $this->getCharacter()->getAttackDamage();
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->getCharacter()->getName();
    }

    /**
     * @return int
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @return int
     */
    public function getMaxHealth() {
        return $this->getCharacter()->getMaxHealth();
    }
} 