<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\Film;
use Site\ParnalBundle\Form\FilmType;
use Site\ParnalBundle\Form\FilmCreateType;

/**
 * Film controller.
 *
 */
class FilmController extends Controller
{
    /**
     * Lists all Film entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Film')->findAlltrie();

        return $this->render('SiteParnalBundle:Film:index.html.twig', array(
            'entities' => $entities
        ));
    }

    
    /**
     * Lists all Film actif.
     *
     */
    public function indexactifAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Film')->findActif(TRUE);

        return $this->render('SiteParnalBundle:Film:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Lists all Film non actif.
     *
     */
    public function indexnactifAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Film')->findActif(FALSE);

        return $this->render('SiteParnalBundle:Film:index.html.twig', array(
            'entities' => $entities
        ));
    }

    
    /**
     * Lists all Film non classe.
     *
     */
    public function indexnclasseAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Film')->findNclasse();

        return $this->render('SiteParnalBundle:Film:index.html.twig', array(
            'entities' => $entities
        ));
    }    
    
    /**
     * Finds and displays a Film entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Film')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Film entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Film:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Film entity.
     *
     */
    public function newAction()
    {
        $entity = new Film();
        $entity->setDateSortie(new \DateTime());
        $entity->setSourceimage("Coté Cinéma");
        $form   = $this->createForm(new FilmCreateType(), $entity);

        return $this->render('SiteParnalBundle:Film:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Film entity.
     *
     */
    public function createAction()
    {
        $entity  = new Film();
        $request = $this->getRequest();
        $form    = $this->createForm(new FilmCreateType(), $entity);
        $entity->setActif(TRUE);
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
        return $this->render('SiteParnalBundle:Film:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Film entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Film')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Film entity.');
        }
        $editForm = $this->createForm(new FilmType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Film:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Film entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Film')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Film entity.');
        }

        $editForm   = $this->createForm(new FilmType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            if ($entity->getFile()!=NULL) $this->modifTailleAffiche($entity);            
            $em->persist($entity);
            $em->flush();
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent("{ reponse : 1}");
            return $response; 
        }

        return $this->render('SiteParnalBundle:Film:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Film entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SiteParnalBundle:Film')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Film entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
    }
    
      
    public function ajaxReaAction()
    {
     $request = $this->getRequest();
     $real = $request->query->get('real');
     $em = $this->getDoctrine()->getEntityManager();

     $lesrealisateurs = $em->getRepository('SiteParnalBundle:Film')->findLesRealisateurs($real); 
     $response = new \Symfony\Component\HttpFoundation\Response();
     $response->setContent(json_encode($lesrealisateurs));

     return $response;
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function rangerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Film')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Film entity.');
        }
        else
        {
            $entity->setActif(false);
            $em->persist($entity);
            $em->flush();
            $entities = $em->getRepository('SiteParnalBundle:Film')->findActif(TRUE);

            return $this->render('SiteParnalBundle:Film:index.html.twig', array(
               'entities' => $entities
        ));
        }    
        
    }
    
    public function activerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Film')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Film entity.');
        }
        else
        {
            $entity->setActif(true);
            $em->persist($entity);
            $em->flush();
            $entities = $em->getRepository('SiteParnalBundle:Film')->findActif(TRUE);

            return $this->render('SiteParnalBundle:Film:index.html.twig', array(
               'entities' => $entities
        ));
        }  
    }
    public function rangertoutAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Film')->findActif(TRUE);
        foreach ($entities as $entity) {
            $entity->setActif(false);
            $em->persist($entity);
            $em->flush();            
        }
        
        $entities = $em->getRepository('SiteParnalBundle:Film')->findActif(TRUE);

        return $this->render('SiteParnalBundle:Film:index.html.twig', array(
            'entities' => $entities
        ));
    }
    private function modifTailleAffiche($entity)
    {
        // Définition de la largeur
        $width = 151;
        $heightf = 201;

        $filename = $entity->getFile();
        list($width_orig, $height_orig) = getimagesize($filename);

        
        $ratio_orig = $width_orig/$height_orig;
        //calcul de la hauteur voulue
        $height = $width/$ratio_orig;
   
        // Redimensionnement
        $image_p = imagecreatetruecolor($width, $height);
        $image_f = imagecreatetruecolor($width, $heightf);
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagecopy($image_f, $image_p, 0, 0, 0, 0, $width, $heightf);

        // enregistrement
        $nom_fichier = $filename->getClientOriginalName();
        imagejpeg($image_f, 'img_film/affiches/'. $nom_fichier, 100);
	$entity->setimage($nom_fichier);
        imagedestroy($image);
        imagedestroy($image_p);
        imagedestroy($image_f);
    }
}
