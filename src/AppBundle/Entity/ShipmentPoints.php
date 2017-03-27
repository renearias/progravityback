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



    /**
     * Get id
     *
     * @return boolean
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return ShipmentPoints
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return ShipmentPoints
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetNumber
     *
     * @param integer $streetNumber
     *
     * @return ShipmentPoints
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return integer
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set activeHours
     *
     * @param string $activeHours
     *
     * @return ShipmentPoints
     */
    public function setActiveHours($activeHours)
    {
        $this->activeHours = $activeHours;

        return $this;
    }

    /**
     * Get activeHours
     *
     * @return string
     */
    public function getActiveHours()
    {
        return $this->activeHours;
    }
    
    public function __toString() {
        return $this->place;
    }
}
