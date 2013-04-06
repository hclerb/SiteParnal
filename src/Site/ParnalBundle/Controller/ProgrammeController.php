<?php

namespace Site\ParnalBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;

use Site\ParnalBundle\Entity\Programme;
use Site\ParnalBundle\Form\ProgrammeType;
use Site\ParnalBundle\Form\ProgrammeCreateType;

/**
 * Programme controller.
 *
 */
class ProgrammeController extends Controller
{
    /**
     * Lists all Programme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Programme')->findAll();

        return $this->render('SiteParnalBundle:Programme:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Programme entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Programme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Programme:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Programme entity.
     *
     */
    public function newAction()
    {
        $entity = new Programme();
        $entity->setFinaffichage(new \DateTime());
        $form   = $this->createForm(new ProgrammeCreateType(), $entity);

        return $this->render('SiteParnalBundle:Programme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Programme entity.
     *
     */
    public function createAction()
    {
        $entity  = new Programme();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProgrammeCreateType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $filename = $entity->getFile();
            $nom_fichier = $filename->getClientOriginalName();
            $filename->move('img_film/telechargements/', $nom_fichier);
            $entity->setFichier($nom_fichier);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent("{ reponse : 1}");
            return $response; 
            
        }

        return $this->render('SiteParnalBundle:Programme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Programme entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Programme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programme entity.');
        }
        $entity->setFile(new File('img_film/telechargements/'.$entity->getFichier()));
        $editForm = $this->createForm(new ProgrammeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Programme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Programme entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Programme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programme entity.');
        }


        $editForm   = $this->createForm(new ProgrammeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {
            if ($entity->getFile()!=NULL)
            {
              $filename = $entity->getFile();
              $nom_fichier = $filename->getClientOriginalName();
              $filename->move('img_film/telechargements/', $nom_fichier);
              $entity->setFichier($nom_fichier);
            }
            $em->persist($entity);
            $em->flush();

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent("{ reponse : 1}");
            return $response; 
        }

        return $this->render('SiteParnalBundle:Programme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Programme entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SiteParnalBundle:Programme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Programme entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
