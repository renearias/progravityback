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
     * @ORM\Column(name="shipment_method", type="boolean", nullable=false)
     */
    private $shipmentMethod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="units", type="boolean", nullable=false)
     */
    private $units = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_payed", type="boolean", nullable=false)
     */
    private $isPayed = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_finished", type="boolean", nullable=false)
     */
    private $isFinished = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="note_id", type="integer", nullable=true)
     */
    private $noteId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_buspack", type="boolean", nullable=true)
     */
    private $isBuspack = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_trash", type="boolean", nullable=false)
     */
    private $isTrash = '0';

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


}

