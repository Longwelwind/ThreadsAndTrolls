<?php


namespace ThreadsAndTrolls\Entity;

/**
 * @Entity
 */
class SpellFireball extends Spell {

    public function onCast(Adventure $adventure, AdventureCharacter $caster, $arguments)
    {
        $target = $arguments[0];

        $fireDamage = $this->getDamageAmount($caster);

        $caster->inflictDamage($target, $fireDamage);
    }

    public function getDamageAmount(AdventureCharacter $caster) {
        return 2*$caster->getStatisticAmount(Statistic::getStatistic(Statistic::INTELLIGENCE));
    }


    public function processArguments(Adventure $adventure, AdventureCharacter $caster, $argumentsRaw)
    {
        if (count($argumentsRaw) != 1)
            return false;

        $monster = Monster::getMonster($argumentsRaw[0]);
        if ($monster == null)
            return false;

        return array($monster);
    }

    public function getDescription(AdventureCharacter $adventureCharacter)
    {
        return "lol";
    }

}