<?php

namespace ChronopostPickupPoint\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ChronopostPickupPoint\Model\Map\ChronopostPickupPointPriceTableMap;
use Propel\Runtime\Map\TableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\Attribute\Relation;
use Thelia\Api\Bridge\Propel\State\PropelCollectionProvider;
use Thelia\Api\Bridge\Propel\State\PropelItemProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/chronopost/pickup-point/{id}',
            name: 'api_chronopost_pickup_point_get_id',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/admin/chronopost/pickup-point',
            name: 'api_chronopost_pickup_point_get_collection',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]],
    denormalizationContext: ['groups' => [self::GROUP_ADMIN_WRITE]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/chronopost/pickup-point/{id}',
            name: 'api_chronopost_pickup_point_get_id_front',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/front/chronopost/pickup-point',
            name: 'api_chronopost_pickup_point_get_collection_front',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]],
    denormalizationContext: ['groups' => [self::GROUP_FRONT_WRITE]]
)]
class ChronopostPickupPoint
{
    public const GROUP_ADMIN_READ = 'admin:chronopost_pickup_point:read';
    public const GROUP_ADMIN_WRITE = 'admin:chronopost_pickup_point:write';
    public const GROUP_FRONT_READ = 'front:chronopost_pickup_point:read';
    public const GROUP_FRONT_WRITE = 'front:chronopost_pickup_point:write';

    /**
     * @var int|null
     */
    #[Groups([
        self::GROUP_ADMIN_READ,
        self::GROUP_FRONT_READ
    ])]
    public ?int $id = null;

    /**
     * @var int|null
     */
    #[Groups([
        self::GROUP_ADMIN_READ,
        self::GROUP_ADMIN_WRITE,
        self::GROUP_FRONT_READ
    ])]
    public ?int $sliceId = null;

    /**
     * @var float|null
     */
    #[Groups([
        self::GROUP_ADMIN_READ,
        self::GROUP_ADMIN_WRITE,
        self::GROUP_FRONT_READ
    ])]
    public ?float $maxWeight = null;

    /**
     * @var float|null
     */
    #[Groups([
        self::GROUP_ADMIN_READ,
        self::GROUP_ADMIN_WRITE,
        self::GROUP_FRONT_READ
    ])]
    public ?float $maxPrice = null;

    /**
     * @var float|null
     */
    #[Groups([
        self::GROUP_ADMIN_READ,
        self::GROUP_ADMIN_WRITE,
        self::GROUP_FRONT_READ
    ])]
    public ?float $price = null;

    /**
     * @var float|null
     */
    #[Groups([
        self::GROUP_ADMIN_READ,
        self::GROUP_ADMIN_WRITE,
        self::GROUP_FRONT_READ
    ])]
    public ?float $franco = null;

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
     * @return int|null
     */
    public function getSliceId(): ?int
    {
        return $this->sliceId;
    }

    /**
     * @param int|null $sliceId
     */
    public function setSliceId(?int $sliceId): void
    {
        $this->sliceId = $sliceId;
    }

    /**
     * @return float|null
     */
    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    /**
     * @param float|null $maxWeight
     */
    public function setMaxWeight(?float $maxWeight): void
    {
        $this->maxWeight = $maxWeight;
    }

    /**
     * @return float|null
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * @param float|null $maxPrice
     */
    public function setMaxPrice(?float $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float|null
     */
    public function getFranco(): ?float
    {
        return $this->franco;
    }

    /**
     * @param float|null $franco
     */
    public function setFranco(?float $franco): void
    {
        $this->franco = $franco;
    }

    /**
     * @return TableMap|null
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new ChronopostPickupPointPriceTableMap();
    }
}
