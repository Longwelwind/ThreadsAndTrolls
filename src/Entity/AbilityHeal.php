<?php


namespace ThreadsAndTrolls\Entity;

/**
 * @Entity
 */
class AbilityHeal extends Ability {
    public function onCast(Adventure $adventure, AdventureCharacter $caster, $arguments)
    {
        $target = $arguments[0];

        $caster->healDamage($target, $this->getHealAmount($caster));
    }

    public function getHealAmount(AdventureCharacter $adventureCharacter)
    {
        return $adventureCharacter->getStatisticAmount(Statistic::getStatistic(Statistic::INTELLIGENCE))*2;
    }

    public function processArguments(Adventure $adventure, AdventureCharacter $caster, $argumentsRaw)
    {
        if (count($argumentsRaw) != 1)
            return false;

        if (is_numeric($argumentsRaw[0])) {

            $target = Monster::getMonster($argumentsRaw[0]);

        } else {

            $targetCharacter = Character::getCharacterByName($argumentsRaw[0]);

            if ($targetCharacter == null)
                return false;


            $target = AdventureCharacter::getAdventureCharacter($targetCharacter, $adventure);
        }







        return array($target);
    }

    public function getDescription(Character $adventureCharacter)
    {
        return "Soigne l'allié ciblé de X points de dégats";
    }

}