<?php


namespace ThreadsAndTrolls\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * "character" is unfortunately a reserved keyword in SQL
 * "persona" is used in SQL tables. In PHP code, "character" is used as a convention
 * @Table(name="persona")
 */
class Character {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(length=255)
     */
    private $owner;

    /**
     * @Column(length=255)
     */
    private $name;

    /**
     * @OneToMany(targetEntity="CharacterStatistic", mappedBy="character")
     */
    private $statistics;

    /**
     * @Column(type="integer")
     */
    private $level;

    /**
     * @Column(type="integer")
     */
    private $experience;

    /**
     * @Column(type="integer", name="statistic_points")
     */
    private $statisticPoints;

    /**
     * @OneToOne(targetEntity="Race")
     * @JoinColumn(name="race_id", referencedColumnName="id")
     */
    private $race;

    /**
     * @OneToOne(targetEntity="Profession")
     * @JoinColumn(name="profession_id", referencedColumnName="id")
     */
    private $profession;

    const STATISTIC_POINTS_PER_LEVEL = 2;
    const EXPERIENCE_PER_LEVEL_STEP = 20;

    function __construct($owner, $name, $race, $profession, $level = 1, $experience = 0, $statisticPoints = 0)
    {
        $this->experience = $experience;
        $this->level = $level;
        $this->name = $name;
        $this->owner = $owner;
        $this->race = $race;
        $this->profession = $profession;
        $this->statisticPoints = $statisticPoints;

        $this->statistics = new ArrayCollection();
    }


    public function getStatisticAmount($statistic) {
        $amount = 0;

        // The total amount of a statistic is composed of the amount from the race and the gained amount
        // This is the race amount
        $amount += $this->getRace()->getStatistic($statistic);

        // This is the amount gained
        $statEntry = $this->getStatisticEntry($statistic);
        if ($statEntry != null) {
            $amount += $statEntry->getAmount();
        }

        return $amount;
    }

    public function getStatisticEntry($statistic) {
        return CharacterStatistic::getCharacterStatistic($this, $statistic);
    }

    public function addStatistic($statistic, $amount) {
        $charStat = $this->getStatisticEntry($statistic);

        if ($charStat != null) {
            $charStat->setAmount($charStat->getAmount() + $amount);
        } else {
            $charStat = CharacterStatistic::createCharacterStatistic($this, $statistic);
            $charStat->setAmount($amount);
        }

        return $charStat->getAmount();
    }

    public function rewardExperience($experience) {

        // We first check if the character should level up
        $overflowExperience = $this->getExperience() + $experience - $this->getRequiredExperience($this->getLevel());
        if ($overflowExperience >= 0) {

            // Level up !
            $this->levelUp();
            return 1 + $this->rewardExperience($overflowExperience);

        } else {

            $this->experience += $experience;
            return 0;

        }
    }

    public function assignStatistic($statistic, $amount) {
        if ($amount <= $this->getStatisticPoints()) {
            $this->addStatistic($statistic, $amount);
            $this->statisticPoints -= $amount;
        }
    }

    public function getRequiredExperienceCurrentLevel() {
        return self::getRequiredExperience($this->getLevel());
    }

    public function levelUp() {
        $this->level += 1;
        $this->statisticPoints += self::STATISTIC_POINTS_PER_LEVEL;

        $this->experience = 0;
    }

    public function getAttackDamage() {
        // Secret formula to retrieve the damage of an attack
        return $this->getStatisticAmount(Statistic::getStatistic(Statistic::STRENGTH))*3;
    }

    public static function getRequiredExperience($level) {
        return self::EXPERIENCE_PER_LEVEL_STEP * $level;
    }

    public static function getCharacter($id) {
        return Database::getEntityManager()->find("ThreadsAndTrolls\\Entity\\Character", $id);
    }

    public static function getCharacterByOwner($owner) {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\Character")
            ->findOneBy(array("owner" => $owner));
    }

    public static function getCharacterByName($name) {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\Character")
            ->findOneBy(array("name" => $name));
    }

    public static function createCharacter($owner, $name, $race, $profession) {

        $character = new Character($owner, $name, $race, $profession);

        Database::save($character);

        return $character;

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
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    public function getMaxHealth() {
        return $this->getRace()->getMaxHealth();
    }

    /**
     * @return mixed
     */
    public function getStatisticPoints()
    {
        return $this->statisticPoints;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }
} 