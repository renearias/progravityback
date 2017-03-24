<?php

namespace Multiservices\ArxisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * AJAX controller.
 *
 * @Route("/ajax")
 */
class AjaxController extends Controller
{

    /**
     * Lists all Mensajes entities.
     *
     * @Route("/", name="ajax")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        
    }
    
    /**
     * @Route("/inbox", name="ajax_inbox")
     * @Method("GET")
     * @Template()
     */
    public function inboxAction(Request $request)
    {
         return array();
    }
    
  
   

}
