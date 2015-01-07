<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="spell")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="spell_type", type="string")
 */
abstract class Spell {

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

    abstract public function getDescription(AdventureCharacter $adventureCharacter);

    public static function getSpellByTag($tag) {
        return Database::getRepository("ThreadsAndTrolls\\Entity\\Spell")
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