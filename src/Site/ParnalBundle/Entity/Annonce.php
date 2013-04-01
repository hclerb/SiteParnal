<?php

namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site\ParnalBundle\Entity\Annonce
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text $lannonce
     *
     * @ORM\Column(name="lannonce", type="text")
     */
    private $lannonce;

    /**
     * @var date $debut
     *
     * @ORM\Column(name="debut", type="date")
     */
    private $debut;

    /**
     * @var date $fin
     *
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;


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
     * Set lannonce
     *
     * @param text $lannonce
     */
    public function setLannonce($lannonce)
    {
        $this->lannonce = $lannonce;
    }

    /**
     * Get lannonce
     *
     * @return text 
     */
    public function getLannonce()
    {
        return $this->lannonce;
    }

    /**
     * Set debut
     *
     * @param date $debut
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    /**
     * Get debut
     *
     * @return date 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param date $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    /**
     * Get fin
     *
     * @return date 
     */
    public function getFin()
    {
        return $this->fin;
    }
}