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

 /**
     * @Route("/order/mail", name="orderMail")
     */
     public function mailAction(){


        $dataJson=json_decode(file_get_contents('php://input'));
        $email=$dataJson->email;
        $nombre  = $dataJson->customer->first_name;
        $apellido = $dataJson->customer->last_name;
        $formaPago = $dataJson->payment_gateway_names[0];
        $emailRemitente  = "compras@progravityhealth.com";

        if ($formaPago == 'deliver'){
            
            $template=$this->renderView(
                    'AppBundle:mail:mail.html.twig',
                    array(
                        'units'=>$units,
                        'shipment_text' => $mailing_settings
                    )
                );

        $asuntoEmail = "Información de entrega ProGravity Health";

        $header = 'From: ' . $emailRemitente . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";

        $mensaje = "¡Gracias por su compra! \r\n \r\n";
        $mensaje .= "Hola ".$nombre." ".$apellido.", te informamos los datos necesarios para que retires tu producto por nuestro depósito. Abonarás en EFECTIVO al momento de retirarlo \r\n \r\n";
        $mensaje .= "Dirección: <a href='https://www.google.com/maps/place/11+de+Septiembre+3468,+C1429BIN+CABA,+Argentina/@-34.546707,-58.4628993,17z/data=!3m1!4b1!4m5!3m4!1s0x95bcb427186447c1:0xb1a1115d7c4fbc6c!8m2!3d-34.546707!4d-58.4607106'>11 de Septiembre 3468 (Belgrano, CABA)</a>. \r\n \r\n";
        $mensaje .= "Horarios: Lunes a Viernes - 9:00 a 17:00 hs. \r\n \r\n";
        $para = $email;
        
        $message = \Swift_Message::newInstance()
            ->setSubject($mensaje)
            ->setFrom($emailRemitente,$asuntoEmail)
            ->setTo($email)
            ->setBody(
                $template,
                'text/html'
            );



        $this->container->get('mailer')->send($message);

        $response= new JsonResponse();
        $response->setData(array(
            'status' => 'success',
            'mail'=>['body' => $template]
            
        ));
        return $response;

        }elseif ($formaPago == 'visa'){
           
           $template=$this->renderView(
                    'AppBundle:mail:mail.html.twig',
                    array(
                        'units'=>$units,
                        'shipment_text' => $mailing_settings
                    )
                );

        $asuntoEmail = "Datos Bancarios para su Compra ProGravity Health";

        $header = 'From: ' . $emailRemitente . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";

        $mensaje = "¡Gracias por su compra! \r\n \r\n";
        $mensaje .= "Hola ".$nombre.", te informamos los datos necesarios para que abones tu compra. \r\n \r\n";
        $mensaje .= "Banco de Galicia \r\n";
        $mensaje .= "PROGRAVITY HEALTH S.R.L. \r\n";
        $mensaje .= "Cat Cte N: 6412-1 182-1 \r\n";
        $mensaje .= "CBU: 00701828 20000006412119 \r\n";
        $mensaje .= "CUIT: 30-71514185-6 \r\n \r\n";
        $mensaje .= "Al haber elegido la opción Depósito o Transferencia Bancaria, deberás enviar el comprobante a nuestra casilla: \r\n";
        $mensaje .= "<a href='mailto:compras@progravityhealth.com'>compras@progravityhealth.com</a> \r\n";
        $mensaje .= "Una vez recibido, podremos registrar su pago y habilitar su entrega. \r\n \r\n";
        $para = $email;
        
        $message = \Swift_Message::newInstance()
            ->setSubject($mensaje)
            ->setFrom($emailRemitente, $asuntoEmail)
            ->setTo($email)
            ->setBody(
                $template,
                'text/html'
            );
        $this->container->get('mailer')->send($message);

        $response= new JsonResponse();
        $response->setData(array(
            'status' => 'success',
            'mail'=>['body' => $template]
            
        ));
        return $response;
        }
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
