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
            <div>
                <b>
                    Caractéristiques:
                </b>
            </div>
            <b><?= $character->getStatisticPoints(); ?></b> points de caractéristiques à attribuer
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
            <div>
                <b>
                    Objets:
                </b>
            </div>
            [In progress...]
        </div>

        <div>
            <div>
                <b>
                    Sorts:
                </b>
            </div>
            [In progress...]
        </div>

    </div>
</div>


