<?php
namespace ThreadsAndTrolls\Entity\EffectModel;

use ThreadsAndTrolls\Action\Action;
use ThreadsAndTrolls\Action\ActionEntityAction;
use ThreadsAndTrolls\Entity\Effect;

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