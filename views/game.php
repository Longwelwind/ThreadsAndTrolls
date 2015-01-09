<div>
    <h3 style="margin:0px;">Aventuriers</h3>
</div>
<div class="column-group">
    <?php if ($adventure->getCharacters()->count() > 0) { ?>
    <?php foreach($adventure->getCharacters() as $advCharacter) { ?>
        <div class="all-20">
            <a class="no-style" href="/character/<?= $advCharacter->getCharacter()->getId(); ?>">
                <div class="panel panel-character">
                    <div class="icon icon-<?= $advCharacter->getCharacter()->getProfession()->getTag(); ?> push-center"></div>
                    <div>
                        <b><?= $advCharacter->getName(); ?></b> <small>lvl <?= $advCharacter->getCharacter()->getLevel(); ?></small>
                    </div>
                    <div style="font-size: 12px;">
                        <i>(<?= $advCharacter->getCharacter()->getRace()->getName(); ?>
                            <?= $advCharacter->getCharacter()->getProfession()->getName(); ?>)</i>
                    </div>
                    <div class="push-center">
                        <?= $advCharacter->getHealth(); ?>/<?=$advCharacter->getMaxHealth(); ?>
                    </div>
                    <div class="push-center" style="width: 120px;">
                        <div class="progress-bar">
                            <div class="progress-filled red"
                                 style="width: <?= 100*$advCharacter->getHealth()/$advCharacter->getMaxHealth() ?>%;">

                            </div>

                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
    <?php } else { ?>
        Aucun personnage actuellement
    <?php } ?>
</div>

<?php if ($adventure->getMonsters()->count() > 0) { ?>
<div>
    <h3 style="margin:0px;">Monstres</h3>
</div>

<div class="column-group">
    <?php foreach($adventure->getMonsters() as $monster) { ?>
        <div class="all-20">
            <div class="panel panel-monster">
                <div class="icon icon-gobelin push-center"></div>
                <div>
                    <b><?= $monster->getName(); ?></b> <small>(<?= $monster->getId(); ?>)</small>
                </div>
                <div class="push-center">
                    <?= $monster->getHealth(); ?>/<?=$monster->getMaxHealth(); ?>
                </div>
                <div class="push-center" style="width: 120px;">
                    <div class="progress-bar">
                        <div class="progress-filled red"
                             style="width: <?= 100*$monster->getHealth()/$monster->getMaxHealth() ?>%;">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php } ?>

<div class="column-group">
    <div class="all-75">
        <h3 style="margin:0px;">Evenements</h3>
        <div style="padding: 5px;">
            <table class="ink-table bordered">
                <?php if (count($events) > 0) { ?>
                    <?php foreach($events as $event) { ?>
                        <?=$event->displayRow(); ?>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td class="align-center" rowspan="5">
                            Aucun évènement... pour l'instant
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="all-25" style="padding: 5px;">
        <h3 style="margin:0px;">Objets</h3>
        <div>
            [In progress]
        </div>
    </div>
</div>
