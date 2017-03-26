<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Countries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=5, nullable=false)
     */
    private $countryCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_whitelisted", type="boolean", nullable=false)
     */
    private $isWhitelisted;



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
     *
     * @return Countries
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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

    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return Countries
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set isWhitelisted
     *
     * @param boolean $isWhitelisted
     *
     * @return Countries
     */
    public function setIsWhitelisted($isWhitelisted)
    {
        $this->isWhitelisted = $isWhitelisted;

        return $this;
    }

    /**
     * Get isWhitelisted
     *
     * @return boolean
     */
    public function getIsWhitelisted()
    {
        return $this->isWhitelisted;
    }
}
