<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api")
 */
class ApiUsersController extends Controller
{
    /**
     * @Route("/user.{_format}", name="api_user", options={"expose":true})
     */
    public function apiuserAction()
    {
        $userin = $this->get('security.token_storage')->getToken()->getUser();
        $user=new \stdClass();
        $user->username=$userin->getName();
        $user->picture= $userin->getWebPath();
        $user->activity= 12;
        $response= New JsonResponse();
        $response->setData($user);
        return $response;
    }
}
