<?php


namespace ThreadsAndTrolls\Entity;

/**
 * @Entity
 */
class EffectTest extends EffectModel {

    public function getDuration(LivingEntity $bearer, LivingEntity $origin, $data) {
        return "";
    }
} 