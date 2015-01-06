<tr class="<?php if ($this->isSuccessful()) { ?>tr-green<?php } else { ?>tr-red<?php } ?>">
    <td>
        <div class="icon icon-statistic-test" style="vertical-align: middle;"></div>
        <span>
            <b><?= $this->getAdventureCharacter()->getName(); ?></b> teste son/sa
            <b><?= $this->getStatistic()->getName(); ?></b> (<b><?= $this->getAdventureCharacter()->getStatisticAmount($this->getStatistic()); ?></b>)
            avec un bonus de <b><?= $this->getCountDice(); ?>d<?= $this->getCountDiceSide(); ?></b> (<b><?= $this->getRollDiceResult(); ?></b>)
            pour atteindre <b><?= $this->getRequiredAmount(); ?></b>
            <?php if ($this->isSuccessful()) { ?>
                et réussi en faisant un total de <b><?= $this->getTotalAmount(); ?></b>
            <?php } else { ?>
                mais rate en ne faisant que <b><?= $this->getTotalAmount(); ?></b>
            <?php } ?>
        </span>
    </td>
</tr>
 