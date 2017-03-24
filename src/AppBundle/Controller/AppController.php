<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/build")
 */
class AppController extends Controller
{
    /**
     * @Route("/dashboard/dashboard.{_format}", name="dashboard", options={"expose":true})
     */
    public function dashboardAction(Request $request, $_format='html')
    {
        $response = $this->render('AppBundle:app:dashboard/dashboard.html.twig');
        return $response;
    }
    
    /**
     * @Route("/dashboard/live-feeds.tpl.{_format}", name="live-feeds", options={"expose":true})
     */
    public function livefeedsAction($_format='html')
    {
        return $this->render('AppBundle:app:dashboard/live-feeds.tpl.html.twig');
    }
    
   
    
    
    /**
     * @Route("/components/activities/activities.{_format}", name="activities")
     * @Cache(expires="tomorrow") 
     */
    public function activitiesAction($_format='html')
    {
        return $this->render('AppBundle:app:components/activities/activities.html.twig');
    }
    
    /**
     * @Route("/layout/directives/demo/demo-states.tpl.{_format}", name="demostates")
     */
    public function demostatesAction($_format='html')
    {
        return $this->render('AppBundle:app:layout/directives/demo/demo-states.tpl.html.twig');
    }
    
   
    /**
     * @Route("/components/projects/recent-projects.tpl.{_format}", name="recent-projects")
     */
    public function recentprojectsAction($_format='html')
    {
        return $this->render('AppBundle:app:components/projects/recent-projects.tpl.html.twig');
    }
    
    /**
     * @Route("/components/shortcut/shortcut.tpl.{_format}", name="shortcut")
     * @Cache(expires="tomorrow") 
     */
    public function shortcutAction($_format='html')
    {
        return $this->render('AppBundle:app:components/shortcut/shortcut.tpl.html.twig');
    }
    
    /**
     * @Route("/components/cases/recent-cases.tpl.{_format}", name="recent-cases", options={"expose":true})
     */
    public function recentcasesAction($_format='html')
    {
        return $this->render('AppBundle:app:components/cases/recent-cases.tpl.html.twig');
    }
    
    /**
     * @Route("/components/language/language-selector.tpl.{_format}", name="language-selector", options={"expose":true})
     * @Cache(expires="tomorrow") 
     */
    public function languageselectorAction($_format='html')
    {
        return $this->render('AppBundle:app:components/language/language-selector.tpl.html.twig');
    }        
    
    
    /**
     * @Route("/auth/directives/login-info.tpl{_format}", name="logininfo", options={"expose":true})
     */
    public function logininfoAction($_format='html')
    {
        return $this->render('AppBundle:app:auth/directives/login-info.tpl.html.twig');
    }  
    
    /**
     * @Route("/components/activities/tabs/tab-msgs.{_format}", name="tab-msgs")
     * @Cache(expires="tomorrow") 
     */
    public function tabmsgsAction($_format='html')
    {
        return $this->render('AppBundle:app:components/activities/tabs/tab-msgs.html.twig');
    }
    
    /**
     * @Route("/components/activities/tabs/tab-notify.{_format}", name="tab-notify")
     * @Cache(expires="tomorrow") 
     */
    public function tabnotifyAction($_format='html')
    {
        return $this->render('AppBundle:app:components/activities/tabs/tab-notify.html.twig');
    }          
    
    /**
     * @Route("/components/activities/tabs/tab-tasks.{_format}", name="tab-tasks")
     * @Cache(expires="tomorrow")
     */
    public function tabtasksAction($_format='html')
    {
        return $this->render('AppBundle:app:components/activities/tabs/tab-tasks.html.twig');
    }          
    /**
     * @Route("/components/activities/tabs/tab-default.{_format}", name="tab-default")
     * @Cache(expires="tomorrow")
     */
    public function tabdefaultAction($_format='html')
    {
        return $this->render('AppBundle:app:components/activities/tabs/tab-default.html.twig');
    }          
}
