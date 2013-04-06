<?php
namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Site\ParnalBundle\Entity\Seance;

/**
 * Site\ParnalBundle\Entity\CineDebat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\CineDebatRepository")
 * 
 */
class CineDebat extends Seance
{

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
    
    /**
     * @var string $pitch
     *
     * @ORM\Column(name="pitch", type="text")
     */
    private $pitch;


       /**      
    * @ORM\ManyToMany(targetEntity="Site\ParnalBundle\Entity\Intervenant")      
    */     
    protected $lesintervenants;
    
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

    public function __construct()
    {
        $this->lesintervenants = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * Add leiintervenants
     *
     * @param Site\ParnalBundle\Entity\Intervenant $leiintervenants
     */
    public function addIntervenant(\Site\ParnalBundle\Entity\Intervenant $lesintervenants)
    {
        $this->lesintervenants[] = $lesintervenants;
    }

    /**
     * Get leiintervenants
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLesintervenants()
    {
        return $this->lesintervenants;
    }

    public function newlesintervenants()
    {
      $this->lesintervenants = new \Doctrine\Common\Collections\ArrayCollection();        
    }

    public function init_via_seance(\Site\ParnalBundle\Entity\Seance $theseance)
    {
        $this->jour = $theseance->getJour();
        $this->lefilm = $theseance->getLefilm();
        $this->vo = $theseance->getVo();
        $this->argentique = $theseance->getArgentique();
        $this->lemulti = $theseance->getLemulti();
        $this->relief = $theseance->getRelief();
        $this->scolaire = $theseance->getScolaire();
        
    }
}
