<?php

namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Site\ParnalBundle\Entity\Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\ImageRepository")
 */
class Image {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $image
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    protected $image;
    
   /**      
    * @ORM\ManyToOne(targetEntity="Site\ParnalBundle\Entity\Film")      
    */     
    protected $lefilm;


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
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
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
}