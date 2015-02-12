<?php
/**
 * Created by PhpStorm.
 * User: justice
 * Date: 11.02.15
 * Time: 10:15
 */

namespace ThreadsAndTrolls\Action;


use ThreadsAndTrolls\Entity\LivingEntity;

class ActionEntityAction extends Action {
    private $origin;

    public function __construct(LivingEntity $origin, $time) {
        parent::__construct($time);
        $this->origin = $origin;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }
}