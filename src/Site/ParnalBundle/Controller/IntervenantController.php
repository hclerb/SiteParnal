<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\Intervenant;
use Site\ParnalBundle\Form\IntervenantType;

/**
 * Intervenant controller.
 *
 */
class IntervenantController extends Controller
{
    /**
     * Lists all Intervenant entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Intervenant')->findAll();

        return $this->render('SiteParnalBundle:Intervenant:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Lists all Intervenant entities.
     *
     */
    public function recupAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Intervenant')->findAll();
        foreach ($entities as $entity) {
         $valeur['id']=$entity->getid();
         $valeur['nom']=$entity->__toString();
         $ensemble[]=$valeur;
        }
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->setContent(json_encode($ensemble));
        return $response;
    }
    /**
     * Finds and displays a Intervenant entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Intervenant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervenant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Intervenant:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Intervenant entity.
     *
     */
    public function newAction()
    {
        $entity = new Intervenant();
        $form   = $this->createForm(new IntervenantType(), $entity);

        return $this->render('SiteParnalBundle:Intervenant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Intervenant entity.
     *
     */
    public function createAction()
    {
        $entity  = new Intervenant();
        $request = $this->getRequest();
        $form    = $this->createForm(new IntervenantType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->enregistrephoto();
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent("{ reponse : 1}");
            return $response;
            
        }

        return $this->render('SiteParnalBundle:Intervenant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Intervenant entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Intervenant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervenant entity.');
        }

        $editForm = $this->createForm(new IntervenantType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Intervenant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Intervenant entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Intervenant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervenant entity.');
        }

        $editForm   = $this->createForm(new IntervenantType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $entity->enregistrephoto();
            $em->persist($entity);
            $em->flush();

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
        }

        return $this->render('SiteParnalBundle:Intervenant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Intervenant entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SiteParnalBundle:Intervenant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Intervenant entity.');
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
