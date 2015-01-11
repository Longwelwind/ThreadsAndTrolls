<?php


namespace ThreadsAndTrolls\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="profession")
 */
class Profession {

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

    /**
     * @OneToMany(targetEntity="ProfessionAbility", mappedBy="profession")
     */
    private $professionAbilities;

    public function __construct() {
        $this->professionAbilities = new ArrayCollection();
    }

    public function getProfessionAbilityByAbility($ability) {

        foreach ($this->getProfessionAbilities() as $professionAbility) {
            if ($professionAbility->getAbility() == $ability) {
                return $professionAbility;
            }
        }

        return null;
    }

    public function getStartingAbilities()
    {
        $startingAbilities = array();

        foreach ($this->getProfessionAbilities() as $professionAbility) {
            if ($professionAbility->getRequiredLevel() == 0)
                $startingAbilities[] = $professionAbility->getAbility();
        }

        return $startingAbilities;
    }

    public static function getProfessionByTag($tag) {
        return Database::getRepository("ThreadsAndTrolls\\Entity\\Profession")
            ->findOneBy(array("tag" => $tag));
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

    /**
     * @return mixed
     */
    public function getProfessionAbilities()
    {
        return $this->professionAbilities->toArray();
    }
} 