<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\Role\RoleInterface;


/**
* @ORM\Entity
* @ORM\Table(name="admin_roles")
*/
class Role implements RoleInterface, \Serializable
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    /**
    * @ORM\Column(name="nombre",type="string",length=255)
    */
    protected $name;
    /**
    * Get id
    *
    * @return integer
    */
    public function getId()
    {
    return $this->id;
    }
    /**
    * Set name
    *
    * @param string $name
    */
    public function setName($name)
    {
    $this->name = $name;
    }
    /**
    * Get name
    *
    * @return string
    */
    public function getName()
    {
    return $this->name;
    }
    public function getRole() {
    return $this->getName();
    }
    public function __toString() {
    return $this->getRole();
    }
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        /*
         * ! Don't serialize $users field !
         */
        return \json_encode(array(
            $this->id,
            $this->name
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->name
        ) = \json_decode($serialized);
    }
}
