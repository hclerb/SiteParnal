<?php

namespace Site\ParnalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Site\ParnalBundle\Entity\Intervenant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ParnalBundle\Entity\IntervenantRepository")
 */
class Intervenant {
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
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    protected $nom;  
    
    /**
     * @var string $pitch
     *
     * @ORM\Column(name="pitch", type="text")
     */
    protected $pitch;    
    
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

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function enregistrephoto()
    {
        // Définition de la largeur et de la hauteur maximale
        $width = 151;
        $height = 206;

         $fichier = $this->getImage();
        // Cacul des nouvelles dimensions
        list($width_orig, $height_orig) = getimagesize($fichier);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
        $height = $width/$ratio_orig;
        }

        // Redimensionnement
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($fichier);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // enregistrement
        $nom_fichier = $fichier->getClientOriginalName();
        imagejpeg($image_p, 'img_film/photosintervenant/'.$nom_fichier, 100);
	$this->setimage($nom_fichier);
    }
    public function __toString() {
        return ' - ' . $this->nom . ' - ';
    }    
}