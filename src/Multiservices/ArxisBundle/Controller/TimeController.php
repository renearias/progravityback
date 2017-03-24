<?php

/*
 * Multiservices (c) 2014 - Todos los derechos reservados.
 */

/**
 * Description of TimeController
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */

namespace Multiservices\ArxisBundle\Controller;

class TimeController {
    
    function transcurido($time) {
    $transcurido = time()-$time;
    $tc['minutos'] = @$transcurido/60;
    $tc['horas'] = @$transcurido/3600;
    $tc['dias'] = @$transcurido/86400;
    $tc['meses'] = @$transcurido/'2629743,83';
    $tc['años'] = @$transcurido/31556926;
    $plu['minutos'] = (intval($tc['minutos'])==1) ? NULL : 's';
    $plu['horas'] = (intval($tc['horas'])==1) ? NULL : 's';
    $plu['dias'] = (intval($tc['dias'])==1) ? NULL : 's';
    $plu['meses'] = (intval($tc['meses'])==1) ? NULL : 's';
    $plu['años'] = (intval($tc['años'])==1) ? NULL : 's';
    $frase = ($transcurido<60 AND $transcurido>15) ? 'menos de un minuto' : $frase;
    $frase = ($transcurido>60 AND $transcurido<3600) ? intval($tc['minutos']).' minuto'.$plu['minutos'] : $frase;
    $frase = ($transcurido>3600 AND $transcurido<86400) ? intval($tc['horas']).' hora'.$plu['horas'] : $frase;
    $frase = ($transcurido>86000 AND $transcurido<'2629743,83') ? intval($tc['dias']).' dia'.$plu['dias'] : $frase;
    $frase = ($transcurido>'2629743,83' AND $transcurido<31556926) ? intval($tc['meses']).' mese'.$plu['meses'] : $frase;
    $frase = ($transcurido>31556926 AND $transcurido<315569260) ? intval($tc['años']).' año'.$plu['años'] : $frase;
    $frase = ($transcurido>3155692600) ? 'mas de 10 años' : $frase;
    return $frase;
}

}
