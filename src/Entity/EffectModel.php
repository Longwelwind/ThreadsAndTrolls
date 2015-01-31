<?php


namespace ThreadsAndTrolls\Entity;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="effect_model")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="effect_type", type="string")
 */
abstract class EffectModel {

    /**
     * @Id
     * @GeneratedColumn
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
    private $icon;

    public static function find($id) {
        return Database::getRepository(self::class)->find($id);
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
    public function getIcon()
    {
        return $this->icon;
    }

} 