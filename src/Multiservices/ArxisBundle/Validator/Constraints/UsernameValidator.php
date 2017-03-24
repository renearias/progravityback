<?php
namespace Multiservices\ArxisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

use AppBundle\Entity\Usuario;
/**
 * Description of UsernameValidator
 *
 * @author Rene Arias
 */
class UsernameValidator extends ConstraintValidator
{
   private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
   private function usernameExiste($value)
   {
       
       $usuario=$this->entityManager->getRepository('AppBundle:Usuario')->findOneByUsernameCanonical($value);
            if (!$usuario) {
                return false;
            }
            else
            {
                return true;  
            }
       
   }
    public function validate($value, Constraint $constraint)
    {
        if (($this->usernameExiste($value))) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}
