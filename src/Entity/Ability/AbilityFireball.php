<?php


namespace ThreadsAndTrolls\Entity\Ability;
use ThreadsAndTrolls\Entity\Adventure;
use ThreadsAndTrolls\Entity\AdventureCharacter;
use ThreadsAndTrolls\Entity\EffectModel\EffectModel;

/**
 * @Entity
 */
class AbilityFireball extends Ability {
    const BURN_EFFECT_MODEL_ID = 1;

    public function onCast(Adventure $adventure, AdventureCharacter $caster, $arguments)
    {
        $target = $arguments[0];

        $fireDamage = $this->getDamageAmount($caster);

        $caster->inflictDamage($target, $fireDamage);

        // We inflict him the burn effect
        $data = array(
            "actionDuration" => 3
        );
        $effectModel = EffectModel::find(self::BURN_EFFECT_MODEL_ID);
        $target->addEffect($caster, $effectModel, $data);
    }

    public function getDamageAmount(AdventureCharacter $caster) {
        return 2*$caster->getStatisticAmount(Statistic::getStatistic(Statistic::INTELLIGENCE));
    }

    public function processArguments(Adventure $adventure, AdventureCharacter $user, $argumentsRaw)
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


        if ($target == null) {
            return false;
        }

        return array($target);
    }

    public function getDescription(Character $adventureCharacter)
    {
        return "Envoie une boule de feu faisant X points de dégats";
    }

}