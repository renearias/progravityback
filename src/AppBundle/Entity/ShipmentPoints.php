<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipmentPoints
 *
 * @ORM\Table(name="shipment_points")
 * @ORM\Entity
 */
class ShipmentPoints
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=64, nullable=false)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=64, nullable=false)
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="street_number", type="integer", nullable=false)
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="active_hours", type="string", length=64, nullable=false)
     */
    private $activeHours;


}

