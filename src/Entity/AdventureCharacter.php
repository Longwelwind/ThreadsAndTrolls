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
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Adventure", inversedBy="characters")
     */
    private $adventure;

    /**
     * @OneToOne(targetEntity="Character")
     */
    private $character;

    public function __construct($character, $adventure, $health) {
        $this->adventure = $adventure;
        $this->character = $character;
        $this->health = $health;
    }

    public function inflictDamage($target, $damage, $damageType = 0) {
        $target->damage($damage);
        EventCharacterAttack::createCharacterAttack($this->getAdventure(), $this, $target, $damage);
    }

    public function attack($target) {
        $damage = $this->getAttackDamage();

        $this->inflictDamage($target, $damage);

        return $damage;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getMaxHealth() {
        return $this->getCharacter()->getMaxHealth();
    }

    /**
     * @return mixed
     */
    public function getAdventure()
    {
        return $this->adventure;
    }

} 