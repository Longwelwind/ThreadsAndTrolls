<?php


namespace ThreadsAndTrolls\Entity;

/**
 * @Entity
 */
class AbilityExecution extends Ability {
    public function onCast(Adventure $adventure, AdventureCharacter $caster, $arguments)
    {
        $target = $arguments[0];
        $damage = 0;

        if ($target->getPercentageHealth() <= 25)
            $damage = $this->getBonusDamage($caster);
        else
            $damage = $this->getBaseDamage($caster);

        $damage = floor($damage);

        $caster->inflictDamage($target, $damage);
    }

    public function getBonusDamage(AdventureCharacter $caster) {
        return $this->getBaseDamage($caster) * 2;
    }

    public function getBaseDamage(AdventureCharacter $caster) {
        return $caster->getStatisticAmount(Statistic::getStatistic(Statistic::DEXTERITY)) * 1.5;
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
        return "Assène un coup puissant à l'ennemi visé. \n"
             . "Si la cible a moins de 25% de ses points de vies, les dégats sont doublés.";
    }

} 