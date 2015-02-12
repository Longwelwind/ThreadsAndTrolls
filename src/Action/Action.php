<?php

namespace ThreadsAndTrolls\Action;

abstract class Action {

    private $cancelled = false;
    private $time;

    const BEFORE = 0;
    const AFTER = 1;

    public function __construct($time) {
        $this->time = $time;
    }

    public function proceed() {
        $this->time = Action::AFTER;
    }

    /**
     * @return mixed
     */
    public function isCancelled()
    {
        return $this->cancelled;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $cancelled
     */
    public function setCancelled($cancelled)
    {
        if ($this->getTime() == Action::AFTER) {
            return;
        }

        $this->cancelled = $cancelled;
    }


}