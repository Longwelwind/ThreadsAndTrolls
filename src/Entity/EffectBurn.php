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

    public function onEntityAction(ActionEntityAction $action, Effect $effect)
    {
        $data = &$effect->getData();

        if ($action->getOrigin() != $effect->getBearer()) {
            return;
        }

        if ($action->getTime() == Action::AFTER) {


            $effect->getOrigin()->inflictDamage($effect->getBearer(), $this->getDamage());

            $data["actionDuration"] -= 1;

            if ($data["actionDuration"] == 0) {
                $this->remove($effect);
            }
        }
    }

    public function getDuration(Effect $effect)
    {
        return $effect->getData()["actionDuration"] . " actions";
    }
}