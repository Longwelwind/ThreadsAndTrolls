<?php


namespace ThreadsAndTrolls\Entity;
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
     * @Column(length=255)
     */
    private $icon;

    public static function getProfessionByTag($tag) {
        return Database::getRepository("ThreadsAndTrolls\\Entity\\Profession")
            ->findOneBy(array("tag" => $tag));
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
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



} 