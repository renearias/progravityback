<?php
namespace Multiservices\ArxisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of UserName
 *
 * @author Rene Arias
 * @Annotation
 */
class Username extends Constraint{
    
    public $message = 'El username: %string% ya existe';
   
    /*public function getTargets()
    {
        return Constraint::CLASS_CONSTRAINT;
    }*/
    
    public function validatedBy()
    {
        return 'username.validator';
    }
}
