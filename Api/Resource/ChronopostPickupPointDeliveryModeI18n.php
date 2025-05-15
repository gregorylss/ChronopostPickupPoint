<?php

namespace ChronopostPickupPoint\Api\Resource;

use Symfony\Component\Serializer\Annotation\Groups;
use Thelia\Api\Resource\I18n;

class ChronopostPickupPointDeliveryModeI18n extends I18n
{
    #[Groups([ChronopostPickupPointDeliveryMode::GROUP_FRONT_READ, ChronopostPickupPointDeliveryMode::GROUP_ADMIN_READ])]
    public ?string $title = null;

    #[Groups([ChronopostPickupPointDeliveryMode::GROUP_FRONT_READ, ChronopostPickupPointDeliveryMode::GROUP_ADMIN_READ])]
    public ?string $callToAction = null;

    #[Groups([ChronopostPickupPointDeliveryMode::GROUP_FRONT_READ, ChronopostPickupPointDeliveryMode::GROUP_ADMIN_READ])]
    public ?string $url = null;

    #[Groups([ChronopostPickupPointDeliveryMode::GROUP_FRONT_READ, ChronopostPickupPointDeliveryMode::GROUP_ADMIN_READ])]
    public ?string $catchphrase = null;

    public function getCallToAction(): ?string
    {
        return $this->callToAction;
    }

    public function setCallToAction(?string $callToAction): ChronopostPickupPointDeliveryModeI18n
    {
        $this->callToAction = $callToAction;
        return $this;
    }

    public function getCatchphrase(): ?string
    {
        return $this->catchphrase;
    }

    public function setCatchphrase(?string $catchphrase): ChronopostPickupPointDeliveryModeI18n
    {
        $this->catchphrase = $catchphrase;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): ChronopostPickupPointDeliveryModeI18n
    {
        $this->title = $title;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): ChronopostPickupPointDeliveryModeI18n
    {
        $this->url = $url;
        return $this;
    }
}
