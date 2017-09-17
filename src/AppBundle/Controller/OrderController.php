<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Order controller.
 *
 */
class OrderController extends Controller
{
    const DEPOSITO_TRANSFERENCIA = 'Deposito o Transferencia Bancaria';
    const PAGO_EN_EFECTIVO ='Pago en Efectivo - (Abona con un 5% de descuento)';
    /**
     * Lists all order entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$orders = $em->getRepository('AppBundle:Order')->findAll();
        
        $datatable = $this->get('appbundle.datatable.order');
        $datatable->buildDatatable();

        return $this->render('order/index.html.twig', array(
            //'orders' => $orders,
            'datatable' => $datatable,
        ));
    }

    /**
     * Lists results order entities.
     *
     */
    public function indexResultsAction(Order $order)
    {
    $datatable = $this->get('appbundle.datatable.order');
    $datatable->buildDatatable();

    $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new order entity.
     *
     */
    public function newAction(Request $request)
    {
        $order = new Order();
        $form = $this->createForm('AppBundle\Form\OrderType', $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            return $this->redirectToRoute('order_show', array('id' => $order->getId()));
        }

        return $this->render('order/new.html.twig', array(
            'order' => $order,
            'form' => $form->createView(),
        ));
    }

     public function mailAction(Request $request)
     {

        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }
        
        $email=$params['email'];
        $name=$params['customer']['first_name'].' '.$params['customer']['last_name'];
        $payment_gateway_names=$params['payment_gateway_names'];
        
        if (in_array(self::DEPOSITO_TRANSFERENCIA,$payment_gateway_names))
        {
             $template=$this->renderView(
                    'AppBundle:mail:mail_deposit.html.twig',
                    array(
                        'name' => $name,
                    )
                );
             
             
        }elseif (in_array(self::PAGO_EN_EFECTIVO,$payment_gateway_names)){
            $template=$this->renderView(
                    'AppBundle:mail:mail_efectivo.html.twig',
                    array(
                        'name' => $name,
                    )
                );
        }else{
            
        }
        
        $message = \Swift_Message::newInstance()
            ->setSubject('ProGravity: Hola '.$name.' ¡Datos Bancarios para su Compra!')
            ->setFrom('compras@progravityhealth.com','ProGravity Health')
            ->setTo($email)
            ->setBody(
                $template,
                'text/html'
            )
        ;
        $this->container->get('mailer')->send($message);

        $response= new JsonResponse();
        $response->setData(array(
            'status' => 'success',
            //'mail'=>['body' => $template]
            
        ));
        return $response;
        
}

        



    
    
    /**
     * Creates a new order entity.
     *
     */
    public function addAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $order = new Order();
        
        $order->setPayerName($request->request->get('name'));
        $order->setPayerSurname($request->request->get('surname'));
        $order->setPayerGender(strtolower($request->request->get('gender')[0]));
        $order->setPayerDni($request->request->get('dni'));
        $order->setPayerPhone($request->request->get('phone'));
        $order->setPayerEmail($request->request->get('email'));
        
        $order->setPayerStreet($request->request->get('street'));
        $order->setPayerStreetNumber($request->request->get('street_number'));
        $order->setPayerFloor($request->request->get('floor'));
        $order->setPayerDepartment($request->request->get('department'));
        $order->setPayerPostalCode($request->request->get('postal_code'));
        $order->setPayerCity($request->request->get('city'));
        $order->setPayerLocality($request->request->get('locality'));
        
        
        if ($request->request->get('province'))
        {   $province = $em->getRepository('AppBundle:Provinces')->find($request->request->get('province'));
            if ($province){
                $order->setPayerProvince($province);
            }
        }
        
        
        
        $order->setPayerAdditionalInfo($request->request->get('additional_info'));
        
        
        $order->setAmount($request->request->get('amount'));
        $order->setPaymentMethod($request->request->get('payment_method'));
        $order->setShipmentMethod($request->request->get('shipment_method'));
        //new_order_submit:true
        //transferencia:false
        
        
        
        $units=$order->getAmount()/5900;
        
        
      

        $em->persist($order);
        $em->flush();
        
        if ($order->getShipmentMethod()== 1)
        {
            $mailing_settings = $em->getRepository('AppBundle:Settings')->find('mailing_mail_delivery')->getValue();
        }else{
           $mailing_settings = $em->getRepository('AppBundle:Settings')->find('mailing_mail_local'); 
           $mailing_settings=array_filter(preg_split('/\R/', $mailing_settings->getValue()));
        }

        $template=$this->renderView(
                    'AppBundle:mail:mail.html.twig',
                    array(
                        'order' => $order,
                        'units'=>$units,
                        'shipment_text' => $mailing_settings
                    )
                );
        
        $message = \Swift_Message::newInstance()
            ->setSubject('ProGravity: Hola '.$order->getPayerName().' ¡Gracias por su compra!')
            ->setFrom('noreply@progravityhealth.com','ProGravity Health')
            ->setTo($order->getPayerEmail())
            ->setBody(
                $template,
                'text/html'
            )
        ;
        $this->container->get('mailer')->send($message);

        $response= new JsonResponse();
        $response->setData(array(
            'status' => 'success',
            'mail'=>['body' => $template]
            
        ));
        return $response;
    }

    /**
     * Finds and displays a order entity.
     *
     */
    public function showAction(Order $order)
    {
        $deleteForm = $this->createDeleteForm($order);

        return $this->render('order/show.html.twig', array(
            'order' => $order,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing order entity.
     *
     */
    public function editAction(Request $request, Order $order)
    {
        $deleteForm = $this->createDeleteForm($order);
        $editForm = $this->createForm('AppBundle\Form\OrderType', $order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_edit', array('id' => $order->getId()));
        }

        return $this->render('order/edit.html.twig', array(
            'order' => $order,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a order entity.
     *
     */
    public function deleteAction(Request $request, Order $order)
    {
        $form = $this->createDeleteForm($order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order);
            $em->flush();
        }

        return $this->redirectToRoute('order_index');
    }

    /**
     * Creates a form to delete a order entity.
     *
     * @param Order $order The order entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Order $order)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('order_delete', array('id' => $order->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
