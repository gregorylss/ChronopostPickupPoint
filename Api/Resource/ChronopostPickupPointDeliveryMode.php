<?php

namespace ChronopostPickupPoint\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ChronopostPickupPoint\Model\Map\ChronopostPickupPointDeliveryModeTableMap;
use Propel\Runtime\Map\TableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\State\PropelCollectionProvider;
use Thelia\Api\Bridge\Propel\State\PropelItemProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/chronopost/pickup-point/delivery-mode/{id}',
            name: 'api_chronopost_pickup_point_delivery_mode_get_id',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/admin/chronopost/pickup-point/delivery-mode',
            name: 'api_chronopost_pickup_point_delivery_mode_get_collection',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]],
    denormalizationContext: ['groups' => [self::GROUP_ADMIN_WRITE]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/chronopost/pickup-point/delivery-mode/{id}',
            name: 'api_chronopost_pickup_point_delivery_mode_get_id_front',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/front/chronopost/pickup-point/delivery-mode',
            name: 'api_chronopost_pickup_point_delivery_mode_get_collection_front',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]],
    denormalizationContext: ['groups' => [self::GROUP_FRONT_WRITE]]
)]
class ChronopostPickupPointDeliveryMode
{
    public const GROUP_ADMIN_READ = 'admin:chronopost_delivery_mode:read';
    public const GROUP_ADMIN_WRITE = 'admin:chronopost_delivery_mode:write';
    public const GROUP_FRONT_READ = 'front:chronopost_delivery_mode:read';
    public const GROUP_FRONT_WRITE = 'front:chronopost_delivery_mode:write';

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $id = null;

    /**
     * @var string|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?string $title = null;

    /**
     * @var string|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?string $code = null;

    /**
     * @var bool|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?bool $freeshippingActive = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?float $freeshippingFrom = null;

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
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return bool|null
     */
    public function getFreeshippingActive(): ?bool
    {
        return $this->freeshippingActive;
    }

    /**
     * @param bool|null $freeshippingActive
     */
    public function setFreeshippingActive(?bool $freeshippingActive): void
    {
        $this->freeshippingActive = $freeshippingActive;
    }

    /**
     * @return float|null
     */
    public function getFreeshippingFrom(): ?float
    {
        return $this->freeshippingFrom;
    }

    /**
     * @param float|null $freeshippingFrom
     */
    public function setFreeshippingFrom(?float $freeshippingFrom): void
    {
        $this->freeshippingFrom = $freeshippingFrom;
    }

    /**
     * @return TableMap|null
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new ChronopostPickupPointDeliveryModeTableMap();
    }
}
