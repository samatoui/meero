<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(
 *     name="orderV1",
 *    indexes={
 *          @ORM\Index(name="marketPlace", columns={"marketPlace"}),
 *          @ORM\Index(name="order_id", columns={"order_id"}),
 *          @ORM\Index(name="flux_id", columns={"flux_id"}),
 *          @ORM\Index(name="mr_id", columns={"mr_id"}),
 *          @ORM\Index(name="ref_id", columns={"ref_id"}),
 *     },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="marketplace", type="string", length=60, nullable=false)
     */
    private $marketPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="order_id", type="string", length=120, nullable=false)
     */
    private $orderId;

    /**
     * @var int
     * @ORM\Column(name="flux_id", type="integer", nullable=false)
     */
    private $fluxId;

    /**
     * @var string
     *
     * @ORM\Column(name="mr_id", type="string", length=120, nullable=false)
     */
    private $mrId;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_id", type="string", length=120, nullable=false)
     */
    private $refId;


    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getMarketPlace()
    {
        return $this->marketPlace;
    }

    /**
     * @param string $marketPlace
     * @return self
     */
    public function setMarketPlace($marketPlace): self
    {
        $this->marketPlace = $marketPlace;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     * @return self
     */
    public function setOrderId($orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return int
     */
    public function getFluxId()
    {
        return $this->fluxId;
    }

    /**
     * @param int $fluxId
     * @return self
     */
    public function setFluxId($fluxId): self
    {
        $this->fluxId = $fluxId;

        return $this;
    }

    /**
     * @return string
     */
    public function getMrId()
    {
        return $this->mrId;
    }

    /**
     * @param string $mrId
     * @return self
     */
    public function setMrId($mrId): self
    {
        $this->mrId = $mrId;

        return $this;
    }

    /**
     * @return string
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * @param string $refId
     * @return self
     */
    public function setRefId($refId): self
    {
        $this->refId = $refId;

        return $this;
    }
}