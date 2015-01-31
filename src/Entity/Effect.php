<?php


namespace ThreadsAndTrolls\Entity;


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
}