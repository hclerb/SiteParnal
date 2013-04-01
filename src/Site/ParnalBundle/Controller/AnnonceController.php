<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\Annonce;
use Site\ParnalBundle\Form\AnnonceType;

/**
 * Annonce controller.
 *
 */
class AnnonceController extends Controller
{
    /**
     * Lists all Annonce entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Annonce')->findAll();

        return $this->render('SiteParnalBundle:Annonce:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Annonce entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Annonce')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Annonce:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Annonce entity.
     *
     */
    public function newAction()
    {
        $entity = new Annonce();
        $form   = $this->createForm(new AnnonceType(), $entity);

        return $this->render('SiteParnalBundle:Annonce:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Annonce entity.
     *
     */
    public function createAction()
    {
        $entity  = new Annonce();
        $request = $this->getRequest();
        $form    = $this->createForm(new AnnonceType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
          if ($entity->getDebut() < $entity->getFin())
          {  
            $em = $this->getDoctrine()->getEntityManager();
            $existetelle = $em->getRepository('SiteParnalBundle:Annonce')->findOneByDebut($entity->getDebut());
            if(!(isset($existetelle)))
            {
              $em->persist($entity);           
              $em->flush();
              $val=1;
            } else $val=2;
          } else $val=3;  
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent($val);
            return $response; 
            
        }

        return $this->render('SiteParnalBundle:Annonce:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Annonce entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Annonce')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }

        $editForm = $this->createForm(new AnnonceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Annonce:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Annonce entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Annonce')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }

        $editForm   = $this->createForm(new AnnonceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
        }

        return $this->render('SiteParnalBundle:Annonce:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Annonce entity.
     *
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SiteParnalBundle:Annonce')->find($id);

        if (!$entity) {
                throw $this->createNotFoundException('Unable to find Annonce entity.');
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
}
