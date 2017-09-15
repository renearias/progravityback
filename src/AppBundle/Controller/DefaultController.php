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
    
    
    /**
     * @Route("/order/mail", name="orderMail")
     */
     public function mailAction(){
        
        $dataJson=json_decode(file_get_contents('php://input'));
        $email=$dataJson->email;
        $nombre  = $dataJson->name;
        $formaPago = $dataJson->formaPago;
        $emailRemitente  = "compras@progravityhealth.com";

        if ($formaPago == 'efectivo') {

        $asuntoEmail = "Información de entrega ProGravity Health";

        $header = 'From: ' . $emailRemitente . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";

        $mensaje = "¡Gracias por su compra! \r\n \r\n";
        $mensaje .= "Hola ".$nombre.", te informamos los datos necesarios para que retires tu producto por nuestro depósito. Abonarás en EFECTIVO al momento de retirarlo \r\n \r\n";
        $mensaje .= "Dirección: <a href='https://www.google.com/maps/place/11+de+Septiembre+3468,+C1429BIN+CABA,+Argentina/@-34.546707,-58.4628993,17z/data=!3m1!4b1!4m5!3m4!1s0x95bcb427186447c1:0xb1a1115d7c4fbc6c!8m2!3d-34.546707!4d-58.4607106'>11 de Septiembre 3468 (Belgrano, CABA)</a>. \r\n \r\n";
        $mensaje .= "Horarios: Lunes a Viernes - 9:00 a 17:00 hs. \r\n \r\n";
        $para = $email;
        mail($para, $asuntoEmail, utf8_decode($mensaje), $header);

            
        }elseif ($formaPago == 'transferencia' || $formaPago == 'deposito') {

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
        mail($para, $asuntoEmail, utf8_decode($mensaje), $header);
            
        }

    }

}
