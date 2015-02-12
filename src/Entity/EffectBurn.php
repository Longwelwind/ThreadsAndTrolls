<?php
/**
 * Created by PhpStorm.
 * User: justice
 * Date: 01.02.15
 * Time: 15:49
 */

namespace ThreadsAndTrolls\Entity;

use ThreadsAndTrolls\Action\Action;
use ThreadsAndTrolls\Action\ActionEntityAction;

/**
 * @Entity
 */
class EffectBurn extends EffectModel
{

    public function getDamage()
    {
        return 5;
    }

    public function onEntityAction(ActionEntityAction $action, LivingEntity $bearer, LivingEntity $origin, &$data)
    {
        if ($action->getOrigin() != $bearer) {
            return;
        }

        if ($action->getTime() == Action::AFTER) {


            $origin->inflictDamage($bearer, 5);

            $data["actionDuration"] -= 1;
        }
    }

    public function getDuration(LivingEntity $bearer, LivingEntity $origin, $data)
    {
        return $data["actionDuration"] . " actions";
    }
}