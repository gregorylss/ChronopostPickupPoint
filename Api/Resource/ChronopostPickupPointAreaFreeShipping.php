<?php

namespace ChronopostPickupPoint\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ChronopostPickupPoint\Model\Map\ChronopostPickupPointAreaFreeshippingTableMap;
use Propel\Runtime\Map\TableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\Attribute\Relation;
use Thelia\Api\Bridge\Propel\State\PropelCollectionProvider;
use Thelia\Api\Bridge\Propel\State\PropelItemProvider;
use ChronopostPickupPoint\Model\ChronopostPickupPointDeliveryMode;
use Thelia\Model\Area;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/chronopost/pickup-point/area-freeshipping/{id}',
            name: 'api_chronopost_pickup_point_area_freeshipping_get_id',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/admin/chronopost/pickup-point/area-freeshipping',
            name: 'api_chronopost_pickup_point_area_freeshipping_get_collection',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]],
    denormalizationContext: ['groups' => [self::GROUP_ADMIN_WRITE]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/chronopost/pickup-point/area-freeshipping/{id}',
            name: 'api_chronopost_pickup_point_area_freeshipping_get_id_front',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/front/chronopost/pickup-point/area-freeshipping',
            name: 'api_chronopost_pickup_point_area_freeshipping_get_collection_front',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]],
    denormalizationContext: ['groups' => [self::GROUP_FRONT_WRITE]]
)]
class ChronopostPickupPointAreaFreeShipping
{
    public const GROUP_ADMIN_READ = 'admin:chronopost_pickup_point_area_freeshipping:read';
    public const GROUP_ADMIN_WRITE = 'admin:chronopost_pickup_point_area_freeshipping:write';
    public const GROUP_FRONT_READ = 'front:chronopost_pickup_point_area_freeshipping:read';
    public const GROUP_FRONT_WRITE = 'front:chronopost_pickup_point_area_freeshipping:write';

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $id = null;

    /**
     * @var Area|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    #[Relation(targetResource: Area::class)]
    public ?Area $area = null;

    /**
     * @var ChronopostPickupPointDeliveryMode|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    #[Relation(targetResource: ChronopostPickupPointDeliveryMode::class)]
    public ?ChronopostPickupPointDeliveryMode $deliveryMode = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?float $cartAmount = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Area|null
     */
    public function getArea(): ?Area
    {
        return $this->area;
    }

    /**
     * @param Area|null $area
     */
    public function setArea(?Area $area): void
    {
        $this->area = $area;
    }

    /**
     * @return ChronopostPickupPointDeliveryMode|null
     */
    public function getDeliveryMode(): ?ChronopostPickupPointDeliveryMode
    {
        return $this->deliveryMode;
    }

    /**
     * @param ChronopostPickupPointDeliveryMode|null $deliveryMode
     */
    public function setDeliveryMode(?ChronopostPickupPointDeliveryMode $deliveryMode): void
    {
        $this->deliveryMode = $deliveryMode;
    }

    /**
     * @return float|null
     */
    public function getCartAmount(): ?float
    {
        return $this->cartAmount;
    }

    /**
     * @param float|null $cartAmount
     */
    public function setCartAmount(?float $cartAmount): void
    {
        $this->cartAmount = $cartAmount;
    }

    /**
     * @return TableMap|null
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new ChronopostPickupPointAreaFreeshippingTableMap();
    }
}
