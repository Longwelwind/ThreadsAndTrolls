<?php


namespace ThreadsAndTrolls\Entity\Event;

/**
 * @Entity
 * @Table(name="event")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="event_type", type="string")
 */
class Event {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="ThreadsAndTrolls\Entity\Adventure", inversedBy="events")
     */
    private $adventure;

    function __construct($adventure)
    {
        $this->adventure = $adventure;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    static function getViewsPath()
    {
        return __DIR__ . "/../../../views/event/";
    }


} 