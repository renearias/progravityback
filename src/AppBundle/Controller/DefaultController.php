<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/app2/example", name="homepage2")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
    
     /**
     * @Route("/", name="homepage")
     * @Route("/inicio", name="inicial")
     * @Route("/clientesactivos", name="clientesactivoshome")
     * @Route("/clientessuspendidos", name="clientessusphome")
     * @Route("/clientesretirados", name="clientesretiradosphome") 
     * @Route("/cambiarequipo", name="cambiarequipo")
     * @Route("/equipos/nuevotipo", name="nuevotipodequipo")
     * @Route("/equipos/tipos", name="listatiposdequipo")
     * @Route("/equipos/tipos/{id}/edit", name="editartiposdequipo")
     * @Route("/tiposdeequipos/{id}", name="mostrartiposdequipo")
     * @Method("GET")
     * @Cache(expires="+1 minute") 
     **/
    public function inicioAction()
    {
        return $this->render('basesmartpanelangular.html.twig');
    }
    
    
}
