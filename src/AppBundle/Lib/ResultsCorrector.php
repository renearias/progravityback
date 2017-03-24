<?php

namespace AppBundle\Lib;

use Doctrine\ORM\Query\Expr\Comparison;

/**
 * Description of ResultsCorrector
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class ResultsCorrector {
    
    public static function validarParte(Comparison $part,$valorBuscado,$valorNuevo){
            if ($part->getLeftExpr()==$valorBuscado){    
            $newpart=new Comparison($valorNuevo,$part->getOperator(),$part->getRightExpr());
            return $newpart;
            }
            return $part;
        }
        
    public static function obtenerPartesValidas($partes, $valorBuscado, $valorNuevo)
    {
        if (!($partes instanceof \Doctrine\ORM\Query\Expr\Comparison)){
        $partesvalidas=[];
        foreach ($partes->getParts() as $parte)
            {
                $partesvalidas[]=self::validarParte($parte, $valorBuscado, $valorNuevo);
            }
        $clase=get_class($partes);    
        return new $clase($partesvalidas);
        }
        else{
           return self::validarParte($partes, $valorBuscado, $valorNuevo);
        }  
    }
}
