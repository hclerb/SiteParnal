<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\CineDebat;
use Site\ParnalBundle\Form\CineDebatType;

/**
 * CineDebat controller.
 *
 */
class CineDebatController extends Controller
{
    /**
     * Lists all Seance entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Seance')->findByordre();
        return $this->render('SiteParnalBundle:CineDebat:index.html.twig', array(
            'entities' => $entities
        ));
    }

      /**
     * Listes Seances restantes avec les films
     *
     */
    public function indexrestantAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Seance')->findrestadmin();
        return $this->render('SiteParnalBundle:CineDebat:index.html.twig', array(
            'entities' => $entities
        ));
    }  
 
    
    /**
     * Listes Seances entre deux dates avec les films
     *
     */
    public function indexentredateAction($date1, $date2)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Seance')->findbetweendateadmin($date1,$date2);

        return $this->render('SiteParnalBundle:SeaCineDebatnce:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a CineDebat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:CineDebat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CineDebat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:CineDebat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new CineDebat entity.
     *
     */
    public function newAction()
    {
        $entity = new CineDebat();
        $entity->setJour(new \Datetime());
        $entity->setHeure(new \DateTime);
        $entity->getHeure()->setTime(21,0);
        $entity->setVo(FALSE);
        $entity->setRelief(FALSE);
        $form   = $this->createForm(new CineDebatType(), $entity);

        return $this->render('SiteParnalBundle:CineDebat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new CineDebat entity.
     *
     */
    public function createAction()
    {
        $entity  = new CineDebat();
        $request = $this->getRequest();
        $form    = $this->createForm(new CineDebatType(), $entity);
        $form->bindRequest($request);
        $entity->setNbgratuits(0);
        $entity->setNbpayants(0);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity->getJour()->setTime($entity->getHeure()->format('H'),$entity->getHeure()->format('i'));
//            $lesintervenants = $entity->getLesintervenants();
            $existetelle = $em->getRepository('SiteParnalBundle:Seance')->findOneByJour($entity->getJour());
            if(!(isset($existetelle)))
            {
              $em->persist($entity);           
              $em->flush();
              $val=1;
            } else $val=2;
            
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent($val);
            return $response; 
            
        }

        return $this->render('SiteParnalBundle:CineDebat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing CineDebat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:CineDebat')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CineDebat entity.');
        }
        $heure = new \DateTime;
        $heure->setTime($entity->getJour()->format('H'),$entity->getJour()->format('i'));
        $entity->setHeure($heure);
        $editForm = $this->createForm(new CineDebatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:CineDebat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CineDebat entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:CineDebat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CineDebat entity.');
        }

        $editForm   = $this->createForm(new CineDebatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $entity->getJour()->setTime($entity->getHeure()->format('H'),$entity->getHeure()->format('i'));             
            $em->persist($entity);
            $em->flush();

            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
        }

        return $this->render('SiteParnalBundle:CineDebat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CineDebat entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SiteParnalBundle:CineDebat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CineDebat entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
        }

        return $this->render('SiteParnalBundle:Admin:suitecrea.html.twig',
                    array ( 'nomsection' => "seance",
                            'nomzone' => "#zoneseance",
                            'numonglet' => 2
                          ));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
