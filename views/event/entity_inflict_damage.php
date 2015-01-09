<tr>
    <td>
        <div class="icon icon-inflict-damage" style="vertical-align: middle;"></div>
        <span>
            <b><?= $this->getAttacker()->getName(); ?></b> a infligé <b><?= $this->getDamage(); ?></b> points de dégats
            à <b><?= $this->getTarget()->getName(); ?></b>
        </span>
    </td>
</tr>
