<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/build/layout")
 */
class LayoutController extends Controller
{
     /**
     * @Route("/layout.tpl.{_format}", name="layout", options={"expose":true})
     * @Cache(expires="tomorrow")
     */
    public function layoutAction(Request $request)
    {
        $response=$this->render('AppBundle:app:layout/layout.tpl.html.twig');
        
        //$response->setETag(md5($response->getContent()),true);
        //$response->setPublic(); // haec que la respuesta sea cacheable
        //$response->setVary(array('Accept-Encoding', 'User-Agent'));
       // $response->setSharedMaxAge(600);
        //$response->isNotModified($request);
        return $response;
    }
    
    /**
     * @Route("/partials/sub-header.tpl.html", name="layout-sub-header")
     */
    public function layoutsubheaderAction()
    {
        /*$em = $this->getDoctrine()->getManager();
        $ingresos= $em->getRepository('PayPayBundle:Ingresos')->last();
        $sumaingresos=0;
        
        foreach ($ingresos as $i)
        {
            $sumaingresos+=$i->getMonto();
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $casos_asisgnados=$em->getRepository('LexBundle:Casos')->casosAsignados($user);;
        $misclientes=$em->getRepository('LexBundle:Contactos')->clientesUsuario($user);;
        return $this->render('AppBundle:app:layout/partials/sub-header.tpl.html.twig',array(
                     'ingresos'=>$ingresos,
                     'sumaingresos'=>$sumaingresos,
                     'miscasos'=>$casos_asisgnados,
                     'misclientes'=>$misclientes
                       ));*/
        return $this->render('AppBundle:app:layout/partials/sub-header.tpl.html.twig');
    }
    
    /**
     * @Route("/partials/header.tpl.html", name="layout-header")
     * @Cache(expires="tomorrow")
     */
    public function layoutheaderAction()
    {
        return $this->render('AppBundle:app:layout/partials/header.tpl.html.twig');
    }
    
    /**
     * @Route("/partials/navigation.tpl.html", name="layout-navigation")
     * @Cache(expires="tomorrow")
     */
    public function layoutnavigationAction()
    {
        return $this->render('AppBundle:app:layout/partials/navigation.tpl.html.twig');
    }
    
    /**
     * @Route("/partials/footer.tpl.html", name="layout-footer")
     * @Cache(expires="tomorrow")
     */
    public function layoutfooterAction()
    {
        return $this->render('AppBundle:app:layout/partials/footer.tpl.html.twig');
    }
    
    /**
     * @Route("/partials/voice-commands.tpl.html", name="layout-voice-commands")
     * @Cache(expires="tomorrow")
     */
    public function layoutvoicecommandsAction()
    {
        return $this->render('AppBundle:app:layout/partials/voice-commands.tpl.html.twig');
    }

}
