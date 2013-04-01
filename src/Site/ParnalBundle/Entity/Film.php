<?php

namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Site\ParnalBundle\Entity\Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\FilmRepository")
 */
class Film
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
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string $realisateur
     *
     * @ORM\Column(name="realisateur", type="string", length=255)
     */
    private $realisateur;
    
    /**
     * @var date $date_sortie
     *
     * @ORM\Column(name="date_sortie", type="date")
     */
    protected $date_sortie;

    /**
     * @var string $duree
     *
     * @ORM\Column(name="duree", type="string", length=255)
     */
    private $duree;

    /**
     * @var smallint $interdiction
     *
     * @ORM\Column(name="interdiction", type="integer")
     */
    private $interdiction;

    /**
     * @var smallint $conseille
     *
     * @ORM\Column(name="conseille", type="integer")
     */
    private $conseille;

    /**
     * @var string $acteurs
     *
     * @ORM\Column(name="acteurs", type="string", length=255)
     */
    private $acteurs;

    /**
     * @var string $synopsis
     *
     * @ORM\Column(name="synopsis", type="text")
     */
    private $synopsis;

    /**
     * @var string $critique
     *
     * @ORM\Column(name="critique", type="text")
     */
    private $critique;

    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255)
     * 
     */
    private $image;

    /**
     * @var boolean $actif
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;
    
    /**
     * @var boolean $artessai
     *
     * @ORM\Column(name="artessai", type="boolean")
     */
    private $artessai;  
    
    /**
     * @var boolean $labjp
     *
     * @ORM\Column(name="labjp", type="boolean")
     */
    private $labjp;    

    /**
     * @var boolean $labrecherche
     *
     * @ORM\Column(name="labrecherche", type="boolean")
     */
    private $labrecherche;    

        /**
     * @var boolean $labpatrimoine
     *
     * @ORM\Column(name="labpatrimoine", type="boolean")
     */
    private $labpatrimoine;    

    /**
     * @var boolean $copieadrc
     *
     * @ORM\Column(name="copieadrc", type="boolean")
     */
    private $copieadrc;
    
    /**
     * @var smallint $provenance
     *
     * @ORM\Column(name="provenance", type="integer")
     */
    private $provenance;
    
        /**
     * @var string $sourceimage
     *
     * @ORM\Column(name="sourceimage", type="string", length=50)
     */
    private $sourceimage;

    
    public function __toString() {
        return $this->titre . ' - ' . $this->realisateur;
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
     * Set realisateur
     *
     * @param string $realisateur
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }

    /**
     * Get realisateur
     *
     * @return string 
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * Set date_sortie
     *
     * @param date $date_sortie
     */
    public function setDateSortie($date_sortie)
    {
        $this->date_sortie = $date_sortie;
    }

    /**
     * Get date_sortie
     *
     * @return date 
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * Set duree
     *
     * @param string $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * Get duree
     *
     * @return string 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set interdiction
     *
     * @param smallint $interdiction
     */
    public function setInterdiction($interdiction)
    {
        $this->interdiction = $interdiction;
    }

    /**
     * Get interdiction
     *
     * @return smallint 
     */
    public function getInterdiction()
    {
        return $this->interdiction;
    }

    /**
     * Set conseille
     *
     * @param smallint $conseille
     */
    public function setConseille($conseille)
    {
        $this->conseille = $conseille;
    }

    /**
     * Get conseille
     *
     * @return smallint 
     */
    public function getConseille()
    {
        return $this->conseille;
    }

    /**
     * Set acteurs
     *
     * @param string $acteurs
     */
    public function setActeurs($acteurs)
    {
        $this->acteurs = $acteurs;
    }

    /**
     * Get acteurs
     *
     * @return string 
     */
    public function getActeurs()
    {
        return $this->acteurs;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set critique
     *
     * @param string $critique
     */
    public function setCritique($critique)
    {
        $this->critique = $critique;
    }

    /**
     * Get critique
     *
     * @return string 
     */
    public function getCritique()
    {
        return $this->critique;
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
     * Set actif
     *
     * @param boolean $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set artessai
     *
     * @param boolean $artessai
     */
    public function setArtessai($artessai)
    {
        $this->artessai = $artessai;
    }

    /**
     * Get artessai
     *
     * @return boolean 
     */
    public function getArtessai()
    {
        return $this->artessai;
    }

    /**
     * Set labjp
     *
     * @param boolean $labjp
     */
    public function setLabjp($labjp)
    {
        $this->labjp = $labjp;
    }

    /**
     * Get labjp
     *
     * @return boolean 
     */
    public function getLabjp()
    {
        return $this->labjp;
    }

    /**
     * Set labrecherche
     *
     * @param boolean $labrecherche
     */
    public function setLabrecherche($labrecherche)
    {
        $this->labrecherche = $labrecherche;
    }

    /**
     * Get labrecherche
     *
     * @return boolean 
     */
    public function getLabrecherche()
    {
        return $this->labrecherche;
    }

    /**
     * Set labpatrimoine
     *
     * @param boolean $labpatrimoine
     */
    public function setLabpatrimoine($labpatrimoine)
    {
        $this->labpatrimoine = $labpatrimoine;
    }

    /**
     * Get labpatrimoine
     *
     * @return boolean 
     */
    public function getLabpatrimoine()
    {
        return $this->labpatrimoine;
    }

    /**
     * Set copieadrc
     *
     * @param boolean $copieadrc
     */
    public function setCopieadrc($copieadrc)
    {
        $this->copieadrc = $copieadrc;
    }

    /**
     * Get copieadrc
     *
     * @return boolean 
     */
    public function getCopieadrc()
    {
        return $this->copieadrc;
    }

    /**
     * Set provenance
     *
     * @param integer $provenance
     */
    public function setProvenance($provenance)
    {
        $this->provenance = $provenance;
    }

    /**
     * Get provenance
     *
     * @return integer 
     */
    public function getProvenance()
    {
        return $this->provenance;
    }
    
    /**
     * Set sourceimage
     *
     * @param string $sourceimage
     */
    public function setSourceimage($sourceimage)
    {
        $this->sourceimage = $sourceimage;
    }

    /**
     * Get sourceimage
     *
     * @return sourceimage 
     */
    public function getSourceimage()
    {
        return $this->sourceimage;
    }
}