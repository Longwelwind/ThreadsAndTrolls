<?php


namespace ThreadsAndTrolls\Entity;


use ThreadsAndTrolls\Action\ActionEntityAction;
use ThreadsAndTrolls\Action\ActionEntityAttack;
use ThreadsAndTrolls\Action\ActionEntityDamage;
use ThreadsAndTrolls\Action\ActionEntityHeal;
use ThreadsAndTrolls\Action\ActionEntityStatGet;
use ThreadsAndTrolls\Action\ActionEntityUseAbility;
use ThreadsAndTrolls\Database;

/**
 * @Entity
 * @Table(name="effect")
 */
class Effect {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="LivingEntity", inversedBy="effects")
     * @JoinColumn(name="bearer_living_entity_id")
     */
    private $bearer;

    /**
     * @OneToOne(targetEntity="LivingEntity")
     * @JoinColumn(name="origin_living_entity_id")
     */
    private $origin;

    /**
     * @OneToOne(targetEntity="EffectModel")
     * @JoinColumn(name="effect_model_id")
     */
    private $model;

    /**
     * @Column(type="json_array")
     */
    private $data;

    function __construct(LivingEntity $origin, LivingEntity $bearer, EffectModel $model, $data)
    {
        $this->data = $data;
        $this->model = $model;
        $this->bearer = $bearer;
        $this->origin = $origin;
    }

    public function getDuration() {
        return $this->model->getDuration($this->bearer, $this->origin, $this->data);
    }

    public function onEntityStatGet(ActionEntityStatGet $action) {
        $this->model->onEntityStatGet($action, $this->bearer, $this->origin, $this->data);
    }

    public function onEntityAttack(ActionEntityAttack $action) {
        $this->model->onEntityAttack($action, $this->bearer, $this->origin, $this->data);
    }

    public function onEntityUseAbility(ActionEntityUseAbility $action) {
        $this->model->onEntityUseAbility($action, $this->bearer, $this->origin, $this->data);
    }

    public function onEntityDamage(ActionEntityDamage $action) {
        $this->model->onEntityDamage($action, $this->bearer, $this->origin, $this->data);
    }

    public function onEntityHeal(ActionEntityHeal $action) {
        $this->model->onEntityHeal($action, $this->bearer, $this->origin, $this->data);
    }

    public function onEntityAction(ActionEntityAction $action) {
        $this->model->onEntityAction($action, $this->bearer, $this->origin, $this->data);
        var_dump($this->data);
    }

    public static function createEffect(LivingEntity $origin, LivingEntity $bearer, EffectModel $model, $data) {
        $effect = new Effect($origin, $bearer, $model, $data);

        Database::save($effect);

        return $effect;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }
}