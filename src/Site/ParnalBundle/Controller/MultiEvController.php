<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\MultiEv;
use Site\ParnalBundle\Form\MultiEvType;

/**
 * MultiEv controller.
 *
 */
class MultiEvController extends Controller
{
    /**
     * Lists all MultiEv entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:MultiEv')->findAll();

        return $this->render('SiteParnalBundle:MultiEv:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a MultiEv entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:MultiEv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MultiEv entity.');
        }

                
        
        $deleteForm = $this->createDeleteForm($id);
       
        return $this->render('SiteParnalBundle:MultiEv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new MultiEv entity.
     *
     */
    public function newAction()
    {
        $entity = new MultiEv();
        $form   = $this->createForm(new MultiEvType(), $entity);

        return $this->render('SiteParnalBundle:MultiEv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new MultiEv entity.
     *
     */
    public function createAction()
    {
        $entity  = new MultiEv();
        $request = $this->getRequest();
        $form    = $this->createForm(new MultiEvType(), $entity);
        $form->bindRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response;     
        }

        
        return $this->render('SiteParnalBundle:MultiEv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing MultiEv entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:MultiEv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MultiEv entity.');
        }

        $editForm = $this->createForm(new MultiEvType(), $entity);

        return $this->render('SiteParnalBundle:MultiEv:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing MultiEv entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:MultiEv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MultiEv entity.');
        }

        $editForm   = $this->createForm(new MultiEvType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
        }

        return $this->render('SiteParnalBundle:MultiEv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a MultiEv entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);
        if ($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SiteParnalBundle:MultiEv')->find($id);

         if (!$entity) {
                throw $this->createNotFoundException('Unable to find MultiEv entity.');
            }

         $em->remove($entity);
         $em->flush();
         $response = new \Symfony\Component\HttpFoundation\Response();
         $response->setContent($id);
         return $response;
        }
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
