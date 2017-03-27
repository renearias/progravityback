<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="FK_orders_notes", columns={"note_id"}), @ORM\Index(name="FK_orders_provinces_id", columns={"payer_province_id"}), @ORM\Index(name="FK_orders_shipment_points_id", columns={"shipment_point_id"})})
 * @ORM\Entity
 */
class Order
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_name", type="string", length=64, nullable=false)
     */
    private $payerName;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_surname", type="string", length=64, nullable=false)
     */
    private $payerSurname;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_gender", type="string", length=1, nullable=false)
     */
    private $payerGender;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_dni", type="string", length=8, nullable=false)
     */
    private $payerDni;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_phone", type="text", length=65535, nullable=false)
     */
    private $payerPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_email", type="text", length=65535, nullable=false)
     */
    private $payerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_street", type="text", length=65535, nullable=true)
     */
    private $payerStreet;

    /**
     * @var integer
     *
     * @ORM\Column(name="payer_street_number", type="integer", nullable=true)
     */
    private $payerStreetNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payer_floor", type="boolean", nullable=true)
     */
    private $payerFloor;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_department", type="string", length=10, nullable=true)
     */
    private $payerDepartment;

    /**
     * @var integer
     *
     * @ORM\Column(name="payer_postal_code", type="integer", nullable=true)
     */
    private $payerPostalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_locality", type="string", length=64, nullable=true)
     */
    private $payerLocality;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_city", type="string", length=64, nullable=true)
     */
    private $payerCity;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_additional_info", type="text", length=65535, nullable=true)
     */
    private $payerAdditionalInfo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payment_method", type="boolean", nullable=false)
     */
    private $paymentMethod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="shipment_method", type="integer", length=1, nullable=false)
     */
    private $shipmentMethod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="units", type="integer", length=2, nullable=false, options={"default":1})
     */
    private $units = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_payed", type="boolean", nullable=false, options={"default":false})
     */
    private $isPayed = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_finished", type="boolean", nullable=false, options={"default":false})
     */
    private $isFinished = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_id", type="integer", nullable=true)
     */
    private $noteId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_buspack", type="boolean", nullable=true, options={"default":false})
     */
    private $isBuspack = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_trash", type="boolean", nullable=false, options={"default":false})
     */
    private $isTrash = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="attended_by", type="boolean", nullable=true)
     */
    private $attendedBy;

    /**
     * @var \Provinces
     *
     * @ORM\ManyToOne(targetEntity="Provinces")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payer_province_id", referencedColumnName="id")
     * })
     */
    private $payerProvince;

    /**
     * @var \ShipmentPoints
     *
     * @ORM\ManyToOne(targetEntity="ShipmentPoints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shipment_point_id", referencedColumnName="id")
     * })
     */
    private $shipmentPoint;


    public function __construct() {
        $this->date= new \DateTime();
    }
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set payerName
     *
     * @param string $payerName
     *
     * @return Order
     */
    public function setPayerName($payerName)
    {
        $this->payerName = $payerName;

        return $this;
    }

    /**
     * Get payerName
     *
     * @return string
     */
    public function getPayerName()
    {
        return $this->payerName;
    }

    /**
     * Set payerSurname
     *
     * @param string $payerSurname
     *
     * @return Order
     */
    public function setPayerSurname($payerSurname)
    {
        $this->payerSurname = $payerSurname;

        return $this;
    }

    /**
     * Get payerSurname
     *
     * @return string
     */
    public function getPayerSurname()
    {
        return $this->payerSurname;
    }

    /**
     * Set payerGender
     *
     * @param string $payerGender
     *
     * @return Order
     */
    public function setPayerGender($payerGender)
    {
        $this->payerGender = $payerGender;

        return $this;
    }

    /**
     * Get payerGender
     *
     * @return string
     */
    public function getPayerGender()
    {
        return $this->payerGender;
    }

    /**
     * Set payerDni
     *
     * @param string $payerDni
     *
     * @return Order
     */
    public function setPayerDni($payerDni)
    {
        $this->payerDni = $payerDni;

        return $this;
    }

    /**
     * Get payerDni
     *
     * @return string
     */
    public function getPayerDni()
    {
        return $this->payerDni;
    }

    /**
     * Set payerPhone
     *
     * @param string $payerPhone
     *
     * @return Order
     */
    public function setPayerPhone($payerPhone)
    {
        $this->payerPhone = $payerPhone;

        return $this;
    }

    /**
     * Get payerPhone
     *
     * @return string
     */
    public function getPayerPhone()
    {
        return $this->payerPhone;
    }

    /**
     * Set payerEmail
     *
     * @param string $payerEmail
     *
     * @return Order
     */
    public function setPayerEmail($payerEmail)
    {
        $this->payerEmail = $payerEmail;

        return $this;
    }

    /**
     * Get payerEmail
     *
     * @return string
     */
    public function getPayerEmail()
    {
        return $this->payerEmail;
    }

    /**
     * Set payerStreet
     *
     * @param string $payerStreet
     *
     * @return Order
     */
    public function setPayerStreet($payerStreet)
    {
        $this->payerStreet = $payerStreet;

        return $this;
    }

    /**
     * Get payerStreet
     *
     * @return string
     */
    public function getPayerStreet()
    {
        return $this->payerStreet;
    }

    /**
     * Set payerStreetNumber
     *
     * @param integer $payerStreetNumber
     *
     * @return Order
     */
    public function setPayerStreetNumber($payerStreetNumber)
    {
        $this->payerStreetNumber = $payerStreetNumber;

        return $this;
    }

    /**
     * Get payerStreetNumber
     *
     * @return integer
     */
    public function getPayerStreetNumber()
    {
        return $this->payerStreetNumber;
    }

    /**
     * Set payerFloor
     *
     * @param boolean $payerFloor
     *
     * @return Order
     */
    public function setPayerFloor($payerFloor)
    {
        $this->payerFloor = $payerFloor;

        return $this;
    }

    /**
     * Get payerFloor
     *
     * @return boolean
     */
    public function getPayerFloor()
    {
        return $this->payerFloor;
    }

    /**
     * Set payerDepartment
     *
     * @param string $payerDepartment
     *
     * @return Order
     */
    public function setPayerDepartment($payerDepartment)
    {
        $this->payerDepartment = $payerDepartment;

        return $this;
    }

    /**
     * Get payerDepartment
     *
     * @return string
     */
    public function getPayerDepartment()
    {
        return $this->payerDepartment;
    }

    /**
     * Set payerPostalCode
     *
     * @param integer $payerPostalCode
     *
     * @return Order
     */
    public function setPayerPostalCode($payerPostalCode)
    {
        $this->payerPostalCode = $payerPostalCode;

        return $this;
    }

    /**
     * Get payerPostalCode
     *
     * @return integer
     */
    public function getPayerPostalCode()
    {
        return $this->payerPostalCode;
    }

    /**
     * Set payerLocality
     *
     * @param string $payerLocality
     *
     * @return Order
     */
    public function setPayerLocality($payerLocality)
    {
        $this->payerLocality = $payerLocality;

        return $this;
    }

    /**
     * Get payerLocality
     *
     * @return string
     */
    public function getPayerLocality()
    {
        return $this->payerLocality;
    }

    /**
     * Set payerCity
     *
     * @param string $payerCity
     *
     * @return Order
     */
    public function setPayerCity($payerCity)
    {
        $this->payerCity = $payerCity;

        return $this;
    }

    /**
     * Get payerCity
     *
     * @return string
     */
    public function getPayerCity()
    {
        return $this->payerCity;
    }

    /**
     * Set payerAdditionalInfo
     *
     * @param string $payerAdditionalInfo
     *
     * @return Order
     */
    public function setPayerAdditionalInfo($payerAdditionalInfo)
    {
        $this->payerAdditionalInfo = $payerAdditionalInfo;

        return $this;
    }

    /**
     * Get payerAdditionalInfo
     *
     * @return string
     */
    public function getPayerAdditionalInfo()
    {
        return $this->payerAdditionalInfo;
    }

    /**
     * Set paymentMethod
     *
     * @param boolean $paymentMethod
     *
     * @return Order
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return boolean
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set shipmentMethod
     *
     * @param boolean $shipmentMethod
     *
     * @return Order
     */
    public function setShipmentMethod($shipmentMethod)
    {
        $this->shipmentMethod = $shipmentMethod;

        return $this;
    }

    /**
     * Get shipmentMethod
     *
     * @return boolean
     */
    public function getShipmentMethod()
    {
        return $this->shipmentMethod;
    }

    /**
     * Set units
     *
     * @param boolean $units
     *
     * @return Order
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * Get units
     *
     * @return boolean
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Order
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set isPayed
     *
     * @param boolean $isPayed
     *
     * @return Order
     */
    public function setIsPayed($isPayed)
    {
        $this->isPayed = $isPayed;

        return $this;
    }

    /**
     * Get isPayed
     *
     * @return boolean
     */
    public function getIsPayed()
    {
        return $this->isPayed;
    }

    /**
     * Set isFinished
     *
     * @param boolean $isFinished
     *
     * @return Order
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    /**
     * Get isFinished
     *
     * @return boolean
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * Set noteId
     *
     * @param integer $noteId
     *
     * @return Order
     */
    public function setNoteId($noteId)
    {
        $this->noteId = $noteId;

        return $this;
    }

    /**
     * Get noteId
     *
     * @return integer
     */
    public function getNoteId()
    {
        return $this->noteId;
    }

    /**
     * Set isBuspack
     *
     * @param boolean $isBuspack
     *
     * @return Order
     */
    public function setIsBuspack($isBuspack)
    {
        $this->isBuspack = $isBuspack;

        return $this;
    }

    /**
     * Get isBuspack
     *
     * @return boolean
     */
    public function getIsBuspack()
    {
        return $this->isBuspack;
    }

    /**
     * Set isTrash
     *
     * @param boolean $isTrash
     *
     * @return Order
     */
    public function setIsTrash($isTrash)
    {
        $this->isTrash = $isTrash;

        return $this;
    }

    /**
     * Get isTrash
     *
     * @return boolean
     */
    public function getIsTrash()
    {
        return $this->isTrash;
    }

    /**
     * Set attendedBy
     *
     * @param boolean $attendedBy
     *
     * @return Order
     */
    public function setAttendedBy($attendedBy)
    {
        $this->attendedBy = $attendedBy;

        return $this;
    }

    /**
     * Get attendedBy
     *
     * @return boolean
     */
    public function getAttendedBy()
    {
        return $this->attendedBy;
    }

    /**
     * Set payerProvince
     *
     * @param \AppBundle\Entity\Provinces $payerProvince
     *
     * @return Order
     */
    public function setPayerProvince(\AppBundle\Entity\Provinces $payerProvince = null)
    {
        $this->payerProvince = $payerProvince;

        return $this;
    }

    /**
     * Get payerProvince
     *
     * @return \AppBundle\Entity\Provinces
     */
    public function getPayerProvince()
    {
        return $this->payerProvince;
    }

    /**
     * Set shipmentPoint
     *
     * @param \AppBundle\Entity\ShipmentPoints $shipmentPoint
     *
     * @return Order
     */
    public function setShipmentPoint(\AppBundle\Entity\ShipmentPoints $shipmentPoint = null)
    {
        $this->shipmentPoint = $shipmentPoint;

        return $this;
    }

    /**
     * Get shipmentPoint
     *
     * @return \AppBundle\Entity\ShipmentPoints
     */
    public function getShipmentPoint()
    {
        return $this->shipmentPoint;
    }
}
