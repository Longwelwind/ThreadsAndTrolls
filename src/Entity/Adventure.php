<?php


namespace ThreadsAndTrolls\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use ThreadsAndTrolls\Action\ActionEntityAction;
use ThreadsAndTrolls\Action\ActionEntityAttack;
use ThreadsAndTrolls\Action\ActionEntityDamage;
use ThreadsAndTrolls\Action\ActionEntityHeal;
use ThreadsAndTrolls\Action\ActionEntityStatGet;
use ThreadsAndTrolls\Action\ActionEntityUseAbility;
use ThreadsAndTrolls\Action\ActionListener;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="adventure")
 */
class Adventure implements ActionListener {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(length=255)
     */
    private $master;

    /**
     * @Column(length=255, name="thread_type")
     */
    private $threadType;

    /**
     * @Column(length=255, name="thread_code")
     */
    private $threadCode;

    /**
     * @OneToMany(targetEntity="AdventureCharacter", mappedBy="adventure")
     */
    private $characters;

    /**
     * @Column(type="boolean")
     */
    private $finished;

    /**
     * @OneToMany(targetEntity="Monster", mappedBy="adventure")
     */
    private $monsters;

    /**
     * @Column(type="integer", name="last_treated_message")
     */
    private $lastTreatedMessage;

    /**
     * @OneToMany(targetEntity="ThreadsAndTrolls\Entity\Event\Event", mappedBy="adventure")
     * @OrderBy({"id" = "ASC"})
     */
    private $events;

    public function __construct() {
        $this->characters = new ArrayCollection();
        $this->monsters = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    /**
     * Returns the specified Adventure from $type and $code
     * @param $type Type of the adventure
     * @param $code Code of the adventure
     * @return Adventure|null The specified adventure, null if not found.
     */
    public static function getGame($type, $code) {
        return Database::getEntityManager()->getRepository(self::class)->findOneBy(array("threadCode" => $code, "threadType" => $type));
    }

    /**
     * Create an adventure
     * @param $master Name of the master of the adventure
     * @param $type Type of the adventure
     * @param $code Code of the adventure
     * @return Adventure The created adventure
     */
    public static function createGame($master, $type, $code) {

        $adventure = new Adventure();
        $adventure->setThreadType($type);
        $adventure->setThreadCode($code);
        $adventure->setMaster($master);
        $adventure->setFinished(false);
        $adventure->setLastTreatedMessage(0);

        Database::getEntityManager()->persist($adventure);
        Database::getEntityManager()->flush();

        return $adventure;

    }

    /**
     * Event function
     */

    public function onEntityStatGet(ActionEntityStatGet $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityStatGet($action);
        }

        foreach ($this->getMonsters() as $livingEntity) {
            $livingEntity->onEntityStatGet($action);
        }
    }

    public function onEntityAttack(ActionEntityAttack $action) {
        $this->onEntityAction($action);

        foreach ($this->getCharacters() as $character) {
            $character->onEntityAttack($action);
        }

        foreach ($this->getMonsters() as $livingEntity) {
            $livingEntity->onEntityAttack($action);
        }
    }

    public function onEntityUseAbility(ActionEntityUseAbility $action) {
        $this->onEntityAction($action);

        foreach ($this->getCharacters() as $character) {
            $character->onEntityAttack($action);
        }

        foreach ($this->getMonsters() as $livingEntity) {
            $livingEntity->onEntityUseAbility($action);
        }
    }

    public function onEntityDamage(ActionEntityDamage $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityDamage($action);
        }

        foreach ($this->getMonsters() as $livingEntity) {
            $livingEntity->onEntityDamage($action);
        }
    }

    public function onEntityHeal(ActionEntityHeal $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityAttack($action);
        }

        foreach ($this->getMonsters() as $livingEntity) {
            $livingEntity->onEntityHeal($action);
        }
    }

    public function onEntityAction(ActionEntityAction $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityAction($action);
        }

        foreach ($this->getMonsters() as $livingEntity) {
            $livingEntity->onEntityAction($action);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Characters[]
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @return boolean
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param boolean $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return int
     */
    public function getLastTreatedMessage()
    {
        return $this->lastTreatedMessage;
    }

    /**
     * @param int $lastTreatedMessage
     */
    public function setLastTreatedMessage($lastTreatedMessage)
    {
        $this->lastTreatedMessage = $lastTreatedMessage;
        Database::save($this);
    }

    /**
     * @return string
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @param string $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * @return string
     */
    public function getThreadCode()
    {
        return $this->threadCode;
    }

    /**
     * @param string $threadCode
     */
    public function setThreadCode($threadCode)
    {
        $this->threadCode = $threadCode;
    }

    /**
     * @return string
     */
    public function getThreadType()
    {
        return $this->threadType;
    }

    /**
     * @param string $threadType
     */
    public function setThreadType($threadType)
    {
        $this->threadType = $threadType;
    }

    /**
     * @return Monster[]
     */
    public function getMonsters()
    {
        return $this->monsters;
    }

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }
} 