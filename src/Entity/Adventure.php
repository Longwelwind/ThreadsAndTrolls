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
     * @OneToMany(targetEntity="Event", mappedBy="adventure")
     * @OrderBy({"id" = "ASC"})
     */
    private $events;

    public function __construct() {
        $this->characters = new ArrayCollection();
        $this->monsters = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public static function getGame($type, $code) {
        return Database::getEntityManager()->getRepository("ThreadsAndTrolls\\Entity\\Adventure")->findOneBy(array("threadCode" => $code, "threadType" => $type));
    }

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
    }

    public function onEntityAttack(ActionEntityAttack $action) {
        $this->onEntityAction($action);

        foreach ($this->getCharacters() as $character) {
            $character->onEntityAttack($action);
        }
    }

    public function onEntityUseAbility(ActionEntityUseAbility $action) {
        $this->onEntityAction($action);

        foreach ($this->getCharacters() as $character) {
            $character->onEntityAttack($action);
        }
    }

    public function onEntityDamage(ActionEntityDamage $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityDamage($action);
        }
    }

    public function onEntityHeal(ActionEntityHeal $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityAttack($action);
        }
    }

    public function onEntityAction(ActionEntityAction $action) {
        foreach ($this->getCharacters() as $character) {
            $character->onEntityAction($action);
        }
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
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @param mixed $characters
     */
    public function setCharacters($characters)
    {
        $this->characters = $characters;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return mixed
     */
    public function getLastTreatedMessage()
    {
        return $this->lastTreatedMessage;
    }

    /**
     * @param mixed $lastTreatedMessage
     */
    public function setLastTreatedMessage($lastTreatedMessage)
    {
        $this->lastTreatedMessage = $lastTreatedMessage;
        Database::save($this);
    }

    /**
     * @return mixed
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @param mixed $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * @return mixed
     */
    public function getThreadCode()
    {
        return $this->threadCode;
    }

    /**
     * @param mixed $threadCode
     */
    public function setThreadCode($threadCode)
    {
        $this->threadCode = $threadCode;
    }

    /**
     * @return mixed
     */
    public function getThreadType()
    {
        return $this->threadType;
    }

    /**
     * @param mixed $threadType
     */
    public function setThreadType($threadType)
    {
        $this->threadType = $threadType;
    }

    /**
     * @return mixed
     */
    public function getMonsters()
    {
        return $this->monsters;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }
} 