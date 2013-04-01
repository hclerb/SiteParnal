<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\Image;
use Site\ParnalBundle\Form\ImageType;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    /**
     * Lists all Image entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Image')->findAll();

        return $this->render('SiteParnalBundle:Image:index.html.twig', array(
            'entities' => $entities
        ));
    }


    /**
     * Lists all Image d'un film.
     *
     */
    public function indexwithfilmAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $lefilm = $em->getRepository('SiteParnalBundle:Film')->find($id);
        $entities = $em->getRepository('SiteParnalBundle:Image')->findByLefilm($id);
        return $this->render('SiteParnalBundle:Image:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Finds and displays a Image entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Image:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Image entity.
     *
     */
    public function newAction()
    {
        $entity = new Image();
        $form   = $this->createForm(new ImageType(), $entity);

        return $this->render('SiteParnalBundle:Image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to create a new Image for a film.
     *
     */
    public function newforfilmAction($id)
    {
        $entity = new Image();
        $em = $this->getDoctrine()->getEntityManager();

        $lefilm = $em->getRepository('SiteParnalBundle:Film')->find($id);
        $entity->setLefilm($lefilm);
        $form   = $this->createForm(new ImageType(), $entity);

        return $this->render('SiteParnalBundle:Image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }
    
    /**
     * Creates a new Image entity.
     *
     */
    public function createAction()
    {
        $entity  = new Image();
        $request = $this->getRequest();
        $form    = $this->createForm(new ImageType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $this->modifTailleAffiche($entity);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent("{ reponse : 1}");
            return $response;            
        }

        return $this->render('SiteParnalBundle:Image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Image entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $editForm = $this->createForm(new ImageType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Image entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $editForm   = $this->createForm(new ImageType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $this->modifTailleAffiche($entity);
            $em->persist($entity);
            $em->flush();

        return $this->render('SiteParnalBundle:Admin:suitecrea.html.twig',
                    array ( 'nomsection' => "film",
                            'nomzone' => "#zonefilm",
                            'numonglet' => 1
                          ));
        }

        return $this->render('SiteParnalBundle:Image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Image entity.
     *
     */
    public function deleteAction($id)
    {
      $em = $this->getDoctrine()->getEntityManager();
      $entity = $em->getRepository('SiteParnalBundle:Image')->find($id);

      if (!$entity) {
                throw $this->createNotFoundException('Unable to find Image entity.');
         }

      $em->remove($entity);
      $em->flush();
     
      $response = new \Symfony\Component\HttpFoundation\Response();
      $response->setContent($id);

      return $response;
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    private function modifTailleAffiche($entity)
    {
        // Définition de la largeur et de la hauteur maximale
        $width = 319;
        $height = 213;
        $widthH = 720;
        $heightH = 480;

        // Cacul des nouvelles dimensions
        $fichier = $entity->getImage();
        list($width_orig, $height_orig) = getimagesize($fichier);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
        $height = $width/$ratio_orig;
        }
        
        if ($widthH/$heightH > $ratio_orig) {
            $widthH = $heightH*$ratio_orig;
        } else {
        $heightH = $widthH/$ratio_orig;
        }

        // Redimensionnement
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($fichier);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        $image_H = imagecreatetruecolor($widthH, $heightH);
        imagecopyresampled($image_H, $image, 0, 0, 0, 0, $widthH, $heightH, $width_orig, $height_orig);
        // enregistrement
        $nom_fichier = $fichier->getClientOriginalName();
        imagejpeg($image_p, 'img_film/photos/'. $nom_fichier, 100);
        $entity->setimage($nom_fichier);
        $nomf = substr_replace($nom_fichier, "H.jpg", strlen($nom_fichier)-4);
        imagejpeg($image_H, 'img_film/photos/'. $nomf, 100);
        imagedestroy($image);
        imagedestroy($image_p);
        imagedestroy($image_H);
    }
}
