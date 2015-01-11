<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="ability")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="ability_class", type="string")
 */
abstract class Ability {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(length=255)
     */
    private $tag;

    /**
     * @Column(length=255)
     */
    private $name;

    /**
     * @Column(length=255)
     */
    private $icon;

    abstract public function onCast(Adventure $adventure, AdventureCharacter $caster, $arguments);

    abstract public function processArguments(Adventure $adventure, AdventureCharacter $caster, $argumentsRaw);

    abstract public function getDescription(Character $adventureCharacter);

    public static function getAbilityByTag($tag) {
        return Database::getRepository("ThreadsAndTrolls\\Entity\\Ability")
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
    public function getIcon()
    {
        return $this->icon;
    }
} 