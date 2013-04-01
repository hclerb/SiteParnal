<?php

namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Site\ParnalBundle\Entity\Programme
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\ProgrammeRepository")
 */
class Programme {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $presentation
     *
     * @ORM\Column(name="presentation", type="text")
     */
    protected $presentation;
    
    /**
     * @var string $fichier
     *
     * @ORM\Column(name="fichier", type="string", length=255)
     */
    protected $fichier;
    
    /**
     * @var date $finaffichage
     *
     * @ORM\Column(name="finaffichage", type="date")
     */    
    protected $finaffichage;


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
     * Set presentation
     *
     * @param string $fichier
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
    }

    /**
     * Get presentation
     *
     * @return string 
     */
    public function getPresentation()
    {
        return $this->presentation;
    }    
    
    /**
     * Set fichier
     *
     * @param string $fichier
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    /**
     * Get fichier
     *
     * @return string 
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set finaffichage
     *
     * @param date $finaffichage
     */
    public function setFinaffichage($finaffichage)
    {
        $this->finaffichage = $finaffichage;
    }

    /**
     * Get finaffichage
     *
     * @return date 
     */
    public function getFinaffichage()
    {
        return $this->finaffichage;
    }
}