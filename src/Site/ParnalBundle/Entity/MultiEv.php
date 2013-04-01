<?php
namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site\ParnalBundle\Entity\MultiEv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\MultiEvRepository")
 */
class MultiEv
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
     *
     * @ORM\OneToMany(targetEntity="Site\ParnalBundle\Entity\Seance", mappedBy="lemulti")
     */
    protected $lesseance;
    
        /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    protected $titre;
    
    /**
     * @var string $pitch
     *
     * @ORM\Column(name="pitch", type="text")
     */
    protected $pitch;

    
    public function __toString() {
        return '- ' . $this->getTitre() .' -' ;
    }
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
  
    public function __construct()
    {
        $this->lesseance = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add lesseance
     *
     * @param Site\ParnalBundle\Entity\Seance $lesseance
     */
    public function addSeance(\Site\ParnalBundle\Entity\Seance $lesseance)
    {
        $this->lesseance[] = $lesseance;
    }

    /**
     * Get lesseance
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLesseance()
    {
        return $this->lesseance;
    }

    /**
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set pitch
     *
     * @param string $pitch
     */
    public function setPitch($pitch)
    {
        $this->pitch = $pitch;
    }

    /**
     * Get pitch
     *
     * @return string 
     */
    public function getPitch()
    {
        return $this->pitch;
    }
}