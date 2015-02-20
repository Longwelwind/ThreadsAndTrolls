<?php


namespace ThreadsAndTrolls\Entity;

/**
 * @Entity
 * @Table(name="profession_ability")
 */
class ProfessionAbility {

    /**
     * @Id
     * @ManyToOne(targetEntity="Profession", inversedBy="professionAbilities")
     * @JoinColumn(name="profession_id", referencedColumnName="id")
     */
    private $profession;

    /**
     * @Id
     * @OneToOne(targetEntity="ThreadsAndTrolls\Entity\Ability\Ability")
     */
    private $ability;

    /**
     * @Column(type="integer", name="required_level")
     */
    private $requiredLevel;

    /**
     * @return mixed
     */
    public function getAbility()
    {
        return $this->ability;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @return mixed
     */
    public function getRequiredLevel()
    {
        return $this->requiredLevel;
    }


} 