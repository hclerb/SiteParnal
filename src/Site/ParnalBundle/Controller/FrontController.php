<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\ParnalBundle\Entity\Email;
use Site\ParnalBundle\Form\EmailType;

class FrontController extends Controller
{   
    public function indexAction()
    {
        $deb = new \DateTime();
        $theday = $deb->format('w');
        if ($theday>=3)$inter='+'.(9-$theday).'day';
         else $inter='+'.(2-$theday).'day';
        
        $fin = clone($deb);
        $fin->modify($inter);
        $em = $this->getDoctrine()->getEntityManager();
        $fin->setTime(23,59);
       $i=0;
       $lannonce = $em->getRepository('SiteParnalBundle:Annonce')->findbetweendate($deb);
       $lesfilms = $em->getRepository('SiteParnalBundle:Seance')->findrestfilmentredate($deb,$fin);
        foreach ($lesfilms as $lefilm) {
            $lesphotos[]= $em->getRepository('SiteParnalBundle:Image')->lesimagesdufilm($lefilm['lefilm']['id']);
            $nbphotos = count($lesphotos[$i]);
            for ($index = 0; $index < $nbphotos; $index++) {
                unset($lesphotos[$i][$index+2]);
            }
            $i++;
        }
       if (!isset($lesphotos)) $lesphotos[]=0;
       $lesseances = $em->getRepository('SiteParnalBundle:Seance')->findbetweendate($deb,$fin);
       return $this->render('SiteParnalBundle:Front:index.html.twig', array(
            'deb'  => $deb,
            'fin'   => $fin,
            'lesseances' => $lesseances,
            'lesphotos' => $lesphotos,
            'lannonce' => $lannonce
       )); 
    }
    
    public function majindexAction()
    {
        $deb = new \DateTime();
        $theday = $deb->format('w');
        if ($theday>=3)$inter='+'.(9-$theday).'day';
         else $inter='+'.(2-$theday).'day';
        
        $fin = clone($deb);
        $fin->modify($inter);
        $em = $this->getDoctrine()->getEntityManager();
        $fin->setTime(23,59);
       $i=0;
       $lannonce = $em->getRepository('SiteParnalBundle:Annonce')->findbetweendate($deb);
       $lesfilms = $em->getRepository('SiteParnalBundle:Seance')->findrestfilmentredate($deb,$fin);
        foreach ($lesfilms as $lefilm) {
            $lesphotos[]= $em->getRepository('SiteParnalBundle:Image')->lesimagesdufilm($lefilm['lefilm']['id']);
            $nbphotos = count($lesphotos[$i]);
            for ($index = 0; $index < $nbphotos; $index++) {
                unset($lesphotos[$i][$index+2]);
            }
            $i++;
        }
       if (!isset($lesphotos)) $lesphotos[]=0;
       $lesseances = $em->getRepository('SiteParnalBundle:Seance')->findbetweendate($deb,$fin);
       return $this->render('SiteParnalBundle:Front:majindex.html.twig', array(
            'deb'  => $deb,
            'fin'   => $fin,
            'lesphotos'=> $lesphotos,
            'lesseances' => $lesseances,
            'lannonce' => $lannonce
       )); 
    }

    public function allAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $lesfilms = $em->getRepository('SiteParnalBundle:Seance')->findrestfilm();
        foreach ($lesfilms as $lefilm) {
            $lesphotos[]= $em->getRepository('SiteParnalBundle:Image')->lesimagesdufilm($lefilm['lefilm']['id']);
        }
        if (!isset($lesphotos)) $lesphotos[]=0;
        $lesseances = $em->getRepository('SiteParnalBundle:Seance')->findrest();
        $lesfilmst = $this->tritableaufilms($lesseances,$lesfilms);
        return $this->render('SiteParnalBundle:Front:tout.html.twig', array(
            'lesfilms' => $lesfilmst,
        ));
    }
    
    public function bysemaineAction()
    {
        $request = $this->getRequest();
        $datedeb = $request->query->get('datedeb');
        $now = new \DateTime();
        $deb = new \DateTime($datedeb);
        if($deb->format('w')==2)
        {
            $deb->modify('-6day');
        }
        if ($now > $deb) $deb=$now;
        $theday = $deb->format('w');
        if ($theday>=3)$inter='+'.(9-$theday).'day';
         else $inter='+'.(2-$theday).'day';
        
        $fin = clone($deb);
        $fin->modify($inter);
        $fin->setTime(23,59);
        $em = $this->getDoctrine()->getEntityManager();
        $i=0;
       $lesfilms = $em->getRepository('SiteParnalBundle:Seance')->findrestfilmentredate($deb,$fin);
        foreach ($lesfilms as $lefilm) {
            $lesphotos[]= $em->getRepository('SiteParnalBundle:Image')->lesimagesdufilm($lefilm['lefilm']['id']);
            $nbphotos = count($lesphotos[$i]);
            for ($index = 0; $index < $nbphotos; $index++) {
                unset($lesphotos[$i][$index+2]);
            }
            $i++;
        }
       if (!isset($lesphotos)) $lesphotos[]=0;
       $lesseances = $em->getRepository('SiteParnalBundle:Seance')->findbetweendate($deb,$fin);
       return $this->render('SiteParnalBundle:Front:parsemaine.html.twig', array(
            'deb'  => $deb,
           'fin'   => $fin,
            'lesphotos'=> $lesphotos,
            'lesseances' => $lesseances
       )); 
    }
    
    public function debatAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SiteParnalBundle:CineDebat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CineDebat entity.');
        }

        return $this->render('SiteParnalBundle:Front:affichedebat.html.twig', array(
            'entity'      => $entity,
        ));
    }

    
    public function thefilmAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SiteParnalBundle:Seance')->findseancethefilm($id);
        $lesphotos[]= $em->getRepository('SiteParnalBundle:Image')->lesimagesdufilm($id);

        $i=0;
        foreach ($lesphotos[0] as $laphoto){
           $lesphotos[0][$i++][0]['image']  = substr_replace($laphoto[0]['image'], "H.jpg", strlen($laphoto[0]['image'])-4);
        }
        
        return $this->render('SiteParnalBundle:Front:afficheunfilm.html.twig', array(
            'entities'      => $entities,
            'lesphotos'   => $lesphotos,
        ));
    }
    
    public function newmailAction()
    {
        $entity = new Email();
        $form   = $this->createForm(new EmailType(), $entity);

        return $this->render('SiteParnalBundle:Front:email.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }    
    public function envoimailAction()
    {
        $entity  = new Email();
        $request = $this->getRequest();
        $form    = $this->createForm(new EmailType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
           $message = \Swift_Message::newInstance()
            ->setSubject($entity->getSujet())
            ->setFrom($entity->getFrom())
            ->setTo('herve@gmail.com')
            ->setBody($entity->getBody());
           $this->get('mailer')->send($message);
           $response = new \Symfony\Component\HttpFoundation\Response();
           $response->setContent(0);
           return $response; 
        }
     
     return $this->render('SiteParnalBundle:Front:email.html.twig', array(
            'entity' => $entity
        ));
    }  
    
    public function telechargementAction()
    {
      $em = $this->getDoctrine()->getEntityManager();

      $lestelechargements = $em->getRepository('SiteParnalBundle:Programme')->recupvalide();
      return $this->render('SiteParnalBundle:Front:telechargement.html.twig', array(
            'lestelechargements' => $lestelechargements
        ));  
    }        


    protected function tritableaufilms($lesseances,$lesfilms){
       $lesfilmst = array();
       foreach ($lesseances as $laseance) {
           $existe=false;
           foreach ($lesfilmst as $lefilm) {
               if($lefilm['lefilm']['id']==$laseance['id']) $existe=true;
           }
           if(!$existe){
               $i=0;
               $pastrouve=true;
               do {
                 if($lesfilms[$i]['lefilm']['id']==$laseance['id']) $pastrouve=false;
                  else $i++;
               }while ($pastrouve);
               $lesfilmst[]=$lesfilms[$i];
           }    
       }
       return $lesfilmst;
    }
         
}
