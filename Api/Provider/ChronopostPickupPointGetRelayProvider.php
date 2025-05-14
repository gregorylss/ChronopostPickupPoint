<?php

namespace ChronopostPickupPoint\Api\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use ChronopostPickupPoint\Controller\ChronopostPickupPointRelayController;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Thelia\Log\Tlog;

/**
 * Exemple de provider "Collection" pour retourner une liste de points relais.
 */
readonly class ChronopostPickupPointGetRelayProvider implements ProviderInterface
{
    public function __construct(
        private ChronopostPickupPointRelayController $relayController
    ) {
    }

    /**
     * @param Operation $operation
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $orderWeight = $context['orderWeight'] ?? null;
        $zipcode     = $context['zipcode'] ?? null;
        $city        = $context['city'] ?? null;
        $countryCode = $context['countryCode'] ?? null;
        $address1    = $context['address1'] ?? null;

        if (null === $orderWeight || null === $countryCode) {
            throw new InvalidArgumentException('Certains paramètres indispensables sont manquants.');
        }

        try {
            $response = $this->relayController->findByAddress(
                $orderWeight,
                $address1,
                $zipcode,
                $city,
                $countryCode
            );

        } catch (\Throwable $e) {
            Tlog::getInstance()->error($e->getMessage());
            $response = [];
        }

        if ($response !== null && !\is_array($response)) {
            $response = [$response];
        }

        return $response ?? [];
    }
}
