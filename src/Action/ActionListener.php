<?php
/**
 * Created by PhpStorm.
 * User: justice
 * Date: 11.02.15
 * Time: 10:51
 */

namespace ThreadsAndTrolls\Action;


interface ActionListener {
    public function onEntityAttack(ActionEntityAttack $action);
    public function onEntityStatGet(ActionEntityStatGet $action);
    public function onEntityUseAbility(ActionEntityUseAbility $action);
    public function onEntityDamage(ActionEntityDamage $action);
    public function onEntityHeal(ActionEntityHeal $action);
    public function onEntityAction(ActionEntityAction $action);
}