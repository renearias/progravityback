<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
 * @ORM\Entity
 */
class Customers
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
     * @ORM\Column(name="surname", type="string", length=64, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=8, nullable=false)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="text", length=65535, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", length=65535, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="text", length=65535, nullable=true)
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="street_number", type="integer", nullable=true)
     */
    private $streetNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="floor", type="boolean", nullable=true)
     */
    private $floor;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=10, nullable=true)
     */
    private $department;

    /**
     * @var integer
     *
     * @ORM\Column(name="postal_code", type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="locality", type="string", length=64, nullable=true)
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=64, nullable=true)
     */
    private $city;

    /**
     * @var boolean
     *
     * @ORM\Column(name="province_id", type="boolean", nullable=true)
     */
    private $provinceId;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_info", type="text", length=65535, nullable=true)
     */
    private $additionalInfo;


}

