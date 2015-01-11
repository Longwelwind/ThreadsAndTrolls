<?php


namespace ThreadsAndTrolls\Entity;

/**
 * @Entity
 */
class AbilityFireball extends Ability {

    public function onCast(Adventure $adventure, AdventureCharacter $caster, $arguments)
    {
        $target = $arguments[0];

        $fireDamage = $this->getDamageAmount($caster);

        $caster->inflictDamage($target, $fireDamage);
    }

    public function getDamageAmount(AdventureCharacter $caster) {
        return 2*$caster->getStatisticAmount(Statistic::getStatistic(Statistic::INTELLIGENCE));
    }


    public function processArguments(Adventure $adventure, AdventureCharacter $user, $argumentsRaw)
    {
        if (count($argumentsRaw) != 1)
            return false;

        $monster = Monster::getMonster($argumentsRaw[0]);
        if ($monster == null)
            return false;

        return array($monster);
    }

    public function getDescription(Character $adventureCharacter)
    {
        return "Envoie une boule de feu faisant X points de dégats";
    }

}