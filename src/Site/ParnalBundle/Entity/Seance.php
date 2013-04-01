<?php

namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\ParnalBundle\Entity\Seance
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\SeanceRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"seance" = "Seance", "cinedebat"="CineDebat"})
 */
class Seance
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var date $jour
     *
     * @ORM\Column(name="jour", type="datetime")
     */
    protected $jour;

     /**
     * @var boolean $vo
     *
     * @ORM\Column(name="vo", type="boolean")
     */
    protected $vo;
    
     /**
     * @var boolean $relief
     *
     * @ORM\Column(name="relief", type="boolean")
     */
    protected $relief;
    
    /**
     * @var boolean $argentique
     *
     * @ORM\Column(name="argentique", type="boolean")
     */
    protected $argentique;
    
    /**
     * @var boolean $scolaire
     *
     * @ORM\Column(name="scolaire", type="boolean")
     */
    protected $scolaire; 
    
    /**
     * @var integer $nbgratuits
     *
     * @ORM\Column(name="nbgratuits", type="integer")
     */
    protected $nbgratuits;    
    
    /**
     * @var integer $nbpayants
     *
     * @ORM\Column(name="nbpayants", type="integer")
     */
    protected $nbpayants; 
    
    /**      
    * @ORM\ManyToOne(targetEntity="Site\ParnalBundle\Entity\Film")      
    */     
    protected $lefilm;

    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Site\ParnalBundle\Entity\MultiEv", inversedBy="lesseances")
     * @ORM\JoinColumn(name="multiev_id", referencedColumnName="id")
     */
    protected $lemulti;
        
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set jour
     *
     * @param date $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * Get jour
     *
     * @return date 
     */
    public function getJour()
    {
        return $this->jour;
    }
    
    /**
     * Set Lefilm
     *
     * @param Site\ParnalBundle\Entity\Film $lefilm
     */
    public function setLefilm(\Site\ParnalBundle\Entity\Film $lefilm)
    {
        $this->lefilm = $lefilm;
    }

    /**
     * Get Lefilm
     *
     * @return Site\ParnalBundle\Entity\Film 
     */
    public function getLefilm()
    {
        return $this->lefilm;
    }


    /**
     * Set lemulti
     *
     * @param Site\ParnalBundle\Entity\MultiEv $lemulti
     */
    public function setLemulti(\Site\ParnalBundle\Entity\MultiEv $lemulti)
    {
        $this->lemulti = $lemulti;
    }

    /**
     * Get lemulti
     *
     * @return Site\ParnalBundle\Entity\MultiEv 
     */
    public function getLemulti()
    {
        return $this->lemulti;
    }

    /**
     * Set vo
     *
     * @param date $vo
     */
    public function setVo($vo)
    {
        $this->vo = $vo;
    }

    /**
     * Get vo
     *
     * @return time 
     */
    public function getVo()
    {
        return $this->vo;
    }      
    
    /**
     * Set relief
     *
     * @param date $relief
     */
    public function setRelief($relief)
    {
        $this->relief = $relief;
    }

    /**
     * Get relief
     *
     * @return time 
     */
    public function getRelief()
    {
        return $this->relief;
    }
    
    /**
     * Set argentique
     *
     * @param boolean $argentique
     */
    public function setArgentique($argentique)
    {
        $this->argentique = $argentique;
    }

    /**
     * Get argentique
     *
     * @return boolean 
     */
    public function getArgentique()
    {
        return $this->argentique;
    }

    /**
     * Set scolaire
     *
     * @param boolean $scolaire
     */
    public function setScolaire($scolaire)
    {
        $this->scolaire = $scolaire;
    }
    
    /**
     * Get scolaire
     *
     * @return boolean 
     */
    public function getScolaire()
    {
        return $this->scolaire;
    }

    /**
     * Get nbpayants
     *
     * @return integer 
     */
    public function getNbpayants()
    {
        return $this->nbpayants;
    }    

    /**
     * Set nbpayants
     *
     * @param integer $nbpayants
     */
    public function setNbpayants($nbpayants)
    {
        $this->nbpayants = $nbpayants;
    }

    /**
     * Get nbgratuits
     *
     * @return integer 
     */
    public function getNbgratuits()
    {
        return $this->nbgratuits;
    }    

    /**
     * Set nbgratuits
     *
     * @param integer $nbgratuits
     */
    public function setNbgratuits($nbgratuits)
    {
        $this->nbgratuits = $nbgratuits;
    }    
    
    
    
    
    protected $heure;
    
    /**
     * Set heure
     *
     * @param date $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * Get heure
     *
     * @return time 
     */
    public function getHeure()
    {
        return $this->heure;
    }    
    
    
}