<h2><?= $character->getName(); ?></h2>
<div class="column-group">
    <div class="all-25" style="padding: 5px;">
        <div class="panel panel-character">
            <div class="icon icon-<?= $character->getProfession()->getTag(); ?> push-center"></div>
            <div>
                <b><?= $character->getName(); ?></b> <small>lvl <?= $character->getLevel(); ?></small>
            </div>
            <div style="font-size: 12px;">
                <i>(<?= $character->getRace()->getName(); ?>
                    <?= $character->getProfession()->getName(); ?>)</i>
            </div>
            <div>
                <b>Vie max:</b> <?= $character->getMaxHealth(); ?>
            </div>
            <div>
                <b>Niveau:</b> <?= $character->getLevel(); ?>
            </div>
            <div>
                <b>Experience:</b> <?= $character->getExperience(); ?>/<?= $character->getRequiredExperienceCurrentLevel(); ?>
            </div>
        </div>

    </div>
    <div class="all-75" style="padding: 5px;">
        <div>
            <h3 class="no-marg-padd">Caractéristiques <small>(<b><?= $character->getStatisticPoints(); ?></b> points à attribuer)</small></h3>
            <table class="ink-table bordered">
                <?php foreach ($stats as $stat) { ?>
                    <tr>
                        <td>
                            <?= $stat->getName(); ?>
                        </td>
                        <td>
                            <?= $character->getStatisticAmount($stat); ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div>
            <h3 class="no-marg-padd">Sorts <small>(<b><?= $character->getAbilityPoints(); ?></b> points de compétence)</small></h3>
            <?php foreach($professionAbilitiesTiers as $professionAbilitiesTier) { ?>

                <?php if ($professionAbilitiesTier["level"] > 0) { ?>
                    <div><b>Compétences de niveau <?= $professionAbilitiesTier["level"] ?></b></div>
                <?php } else { ?>
                    <div><b>Compétences de départ</b></div>
                <?php } ?>

                <?php foreach($professionAbilitiesTier["abilities"] as $professionAbility) { ?>

                    <div class="tt-content" id="tooltip-<?= $professionAbility->getAbility()->getTag() ?>">

                        <div>
                            <b>
                                <?= $professionAbility->getAbility()->getName(); ?>
                            </b>
                            <small>
                                (<?= $professionAbility->getAbility()->getTag(); ?>)
                            </small>
                        </div>
                        <div>
                            <?= $professionAbility->getAbility()->getDescription($character); ?>
                        </div>
                        <div style="margin-top: 6px;">
                            <?php if ($character->isAbilityKnown($professionAbility->getAbility())) { ?>
                                <b>Appris</b>
                            <?php } else { ?>
                                <b>Inconnu</b>
                            <?php } ?>
                        </div>


                    </div>

                    <div class="tt slot <?php if ($character->isAbilityKnown($professionAbility->getAbility())) { ?>
                                                slot-<?= $character->getProfession()->getTag() ?>
                                            <?php } ?>"
                         data-tooltip-template="#tooltip-<?= $professionAbility->getAbility()->getTag() ?>">

                        <div class="icon icon-<?= $professionAbility->getAbility()->getIcon() ?>">
                        </div>

                    </div>

                <?php } ?>

            <?php } ?>
        </div>

    </div>

    <div>
        <h3 class="no-marg-padd">Objets:</h3>
        [In progress...]
    </div>
</div>


