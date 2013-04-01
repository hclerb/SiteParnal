<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\Seance;
use Site\ParnalBundle\Entity\CineDebat;
use Site\ParnalBundle\Form\CineDebatType;
use Site\ParnalBundle\Form\SeanceType;
use Site\ParnalBundle\Form\SeanceentreeType;

/**
 * Seance controller.
 *
 */
class SeanceController extends Controller
{
    /**
     * Lists all Seance entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Seance')->findByordre();
        return $this->render('SiteParnalBundle:Seance:index.html.twig', array(
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
        return $this->render('SiteParnalBundle:Seance:index.html.twig', array(
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

        return $this->render('SiteParnalBundle:Seance:index.html.twig', array(
            'entities' => $entities
        ));
    }
    /**
     * Finds and displays a Seance entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seance entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Seance:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Seance entity.
     *
     */
    public function newAction()
    {
        $entity = new Seance();
        $entity->setJour(new \Datetime());
        $entity->setHeure(new \DateTime);
        $entity->getHeure()->setTime(21,0);
        $entity->setVo(FALSE);
        $entity->setRelief(FALSE);
        $form   = $this->createForm(new SeanceType(), $entity);

        return $this->render('SiteParnalBundle:Seance:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Seance entity.
     *
     */
    public function createAction()
    {

        $entity  = new Seance();
        $request = $this->getRequest();
        $form    = $this->createForm(new SeanceType(), $entity);
        $entity->setNbgratuits(0);
        $entity->setNbpayants(0);
        $form->bindRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity->getJour()->setTime($entity->getHeure()->format('H'),$entity->getHeure()->format('i'));
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

        return $this->render('SiteParnalBundle:Seance:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Seance entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);     
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seance entity.');
        }
        $heure = new \DateTime;
        $heure->setTime($entity->getJour()->format('H'),$entity->getJour()->format('i'));
        $entity->setHeure($heure);
        $editForm = $this->createForm(new SeanceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Seance:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Seance entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seance entity.');
        }

        $editForm   = $this->createForm(new SeanceType(), $entity);
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

        return $this->render('SiteParnalBundle:Seance:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seance entity.
     *
     */
    public function editentreeAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);     
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seance entity.');
        }
        $heure = new \DateTime;
        $heure->setTime($entity->getJour()->format('H'),$entity->getJour()->format('i'));
        $entity->setHeure($heure);
        $editForm = $this->createForm(new SeanceentreeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:Seance:editentree.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Seance entity.
     *
     */
    public function updateentreeAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seance entity.');
        }

        $editForm   = $this->createForm(new SeanceentreeType(), $entity);
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

        return $this->render('SiteParnalBundle:Seance:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Seance entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seance entity.');
            }

            $em->remove($entity);
            $em->flush();
        
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->setContent(1);
            return $response; 
        }
    }
    
    /**
     * Lists all Seance entities.
     *
     */
    public function indexincompAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Seance')->findincompadmin();
        return $this->render('SiteParnalBundle:Seance:index.html.twig', array(
            'entities' => $entities
        ));
    }

    public function nowcinedebatAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:Seance')->find($id);     
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seance entity.');
        }
        $entity_debat  = new CineDebat();
        $entity_debat->init_via_seance($entity);
        $entity_debat->setPitch("");
        $entity_debat->setTitre("");
        $em->remove($entity);
        $em->persist($entity_debat); 
        $em->flush();
        
        $id = $entity_debat->getId();
        $heure = new \DateTime;
        $heure->setTime($entity_debat->getJour()->format('H'),$entity_debat->getJour()->format('i'));
        $entity_debat->setHeure($heure);
        $editForm = $this->createForm(new CineDebatType(), $entity_debat);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteParnalBundle:CineDebat:edit.html.twig', array(
            'entity'      => $entity_debat,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
