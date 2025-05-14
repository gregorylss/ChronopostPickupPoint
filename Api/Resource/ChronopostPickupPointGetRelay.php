<?php

namespace ChronopostPickupPoint\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ChronopostPickupPoint\Api\Provider\ChronopostPickupPointGetRelayProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/admin/chronopost/pickup-point/get-relay',
            name: 'api_chronopost_pickup_point_get_relay_collection',
            provider: ChronopostPickupPointGetRelayProvider::class
        )
    ]
    , normalizationContext: ['groups' => [self::GROUP_READ]]
)]
class ChronopostPickupPointGetRelay
{
    public const GROUP_READ = 'chronopost_pickup_point_get_relay:read';

    #[Groups([self::GROUP_READ])]
    public ?int $id = null;

    #[Groups([self::GROUP_READ])]
    public ?string $name = null;

    #[Groups([self::GROUP_READ])]
    public ?string $address1 = null;

    #[Groups([self::GROUP_READ])]
    public ?string $address2 = null;

    #[Groups([self::GROUP_READ])]
    public ?string $zipCode = null;

    #[Groups([self::GROUP_READ])]
    public ?string $city = null;

    #[Groups([self::GROUP_READ])]
    public ?string $countryCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): void
    {
        $this->address1 = $address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): void
    {
        $this->address2 = $address2;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }
}
