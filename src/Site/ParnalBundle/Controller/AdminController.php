<?php

namespace Site\ParnalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('SiteParnalBundle:Admin:index.html.twig');
    }
}
