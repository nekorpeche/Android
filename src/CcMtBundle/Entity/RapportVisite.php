<?php

namespace CcMtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RapportVisite
 *
 * @ORM\Table(name="Rapport_Visite", indexes={@ORM\Index(name="FK_RV_Praticien", columns={"pra_num"}), @ORM\Index(name="IDX_1B1F3C9F7BFA9247", columns={"vis_matricule"})})
 * @ORM\Entity(repositoryClass="CcMtBundle\Repository\RapportVisiteRepository")
 */
class RapportVisite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="rap_num", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $rapNum = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="rap_bilan", type="string", length=510, nullable=true)
     */
    private $rapBilan = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rap_dateVisite", type="date", nullable=true)
     */
    private $rapDatevisite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rap_dateRapport", type="date", nullable=true)
     */
    private $rapDaterapport;

    /**
     * @var \Praticien
     *
     * @ORM\ManyToOne(targetEntity="Praticien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pra_num", referencedColumnName="pra_num")
     * })
     */
    private $praNum;

    /**
     * @var \Visiteur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vis_matricule", referencedColumnName="vis_matricule")
     * })
     */
    private $visMatricule;



    /**
     * Set rapNum
     *
     * @param integer $rapNum
     *
     * @return RapportVisite
     */
    public function setRapNum($rapNum)
    {
        $this->rapNum = $rapNum;

        return $this;
    }

    /**
     * Get rapNum
     *
     * @return integer
     */
    public function getRapNum()
    {
        return $this->rapNum;
    }

    /**
     * Set rapBilan
     *
     * @param string $rapBilan
     *
     * @return RapportVisite
     */
    public function setRapBilan($rapBilan)
    {
        $this->rapBilan = $rapBilan;

        return $this;
    }

    /**
     * Get rapBilan
     *
     * @return string
     */
    public function getRapBilan()
    {
        return $this->rapBilan;
    }

    /**
     * Set rapDatevisite
     *
     * @param \DateTime $rapDatevisite
     *
     * @return RapportVisite
     */
    public function setRapDatevisite($rapDatevisite)
    {
        $this->rapDatevisite = $rapDatevisite;

        return $this;
    }

    /**
     * Get rapDatevisite
     *
     * @return \DateTime
     */
    public function getRapDatevisite()
    {
        return $this->rapDatevisite;
    }

    /**
     * Set rapDaterapport
     *
     * @param \DateTime $rapDaterapport
     *
     * @return RapportVisite
     */
    public function setRapDaterapport($rapDaterapport)
    {
        $this->rapDaterapport = $rapDaterapport;

        return $this;
    }

    /**
     * Get rapDaterapport
     *
     * @return \DateTime
     */
    public function getRapDaterapport()
    {
        return $this->rapDaterapport;
    }

    /**
     * Set praNum
     *
     * @param \CcMtBundle\Entity\Praticien $praNum
     *
     * @return RapportVisite
     */
    public function setPraNum(\CcMtBundle\Entity\Praticien $praNum = null)
    {
        $this->praNum = $praNum;

        return $this;
    }

    /**
     * Get praNum
     *
     * @return \CcMtBundle\Entity\Praticien
     */
    public function getPraNum()
    {
        return $this->praNum;
    }

    /**
     * Set visMatricule
     *
     * @param \CcMtBundle\Entity\Visiteur $visMatricule
     *
     * @return RapportVisite
     */
    public function setVisMatricule(\CcMtBundle\Entity\Visiteur $visMatricule)
    {
        $this->visMatricule = $visMatricule;

        return $this;
    }

    /**
     * Get visMatricule
     *
     * @return \CcMtBundle\Entity\Visiteur
     */
    public function getVisMatricule()
    {
        return $this->visMatricule;
    }
}
