<?php

namespace ChronopostPickupPoint\Twig;

use ChronopostPickupPoint\ChronopostPickupPoint;
use ChronopostPickupPoint\Config\ChronopostPickupPointConst;
use Propel\Runtime\Exception\PropelException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Log\Tlog;
use Thelia\Model\CountryQuery;
use Thelia\Model\CouponQuery;
use Thelia\Module\Exception\DeliveryException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ChronopostPickupPointExtension extends AbstractExtension
{
    private $requestStack;
    private $dispatcher;

    /**
     * Constructeur de l'extension Twig.
     *
     * @param RequestStack $requestStack
     * @param EventDispatcherInterface|null $dispatcher
     */
    public function __construct(RequestStack $requestStack, EventDispatcherInterface $dispatcher = null)
    {
        $this->requestStack = $requestStack;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Définition des fonctions Twig disponibles.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('chronopostPickupPointDeliveryType', [$this, 'getDeliveryTypeStatus']),
            new TwigFunction('chronopostPickupPointDeliveryPrice', [$this, 'getDeliveryPrice']),
            new TwigFunction('chronopostPickupPointGetDeliveryTypesStatusKeys', [$this, 'getDeliveryTypesStatusKeys']),
        ];
    }

    /**
     * Obtient les statuts des types de livraison.
     *
     * @return array
     */
    public function getDeliveryTypeStatus(): array
    {
        $status = [];
        foreach (ChronopostPickupPointConst::getDeliveryTypesStatusKeys() as $deliveryTypeName => $statusKey) {
            $status['is' . $deliveryTypeName . 'Enabled'] = (bool)ChronopostPickupPoint::getConfigValue($statusKey);
        }
        return $status;
    }

    /**
     * Calcule le prix de livraison.
     *
     * @param int $deliveryMode
     * @param int $countryId
     * @return float|null
     */
    public function getDeliveryPrice(int $deliveryMode, int $countryId): ?float
    {
        $price = null;
        $country = CountryQuery::create()->findOneById($countryId);

        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return null;
        }

        $session = $request->getSession();
        $cart = $session->getSessionCart($this->dispatcher);
        $cartWeight = $cart->getWeight();
        $cartAmount = $cart->getTaxedAmount($country);

        try {
            $price = (new ChronopostPickupPoint())->getMinPostage(
                $country,
                $cartWeight,
                $cartAmount,
                $deliveryMode,
                $session->getLang()->getLocale()
            );

            $consumedCouponsCodes = $session->getConsumedCoupons();

            foreach ($consumedCouponsCodes as $consumedCouponCode) {
                $coupon = CouponQuery::create()
                    ->filterByCode($consumedCouponCode)
                    ->findOne();

                /** @var \Thelia\Model\Coupon $coupon */
                if ($coupon !== null && $coupon->getIsRemovingPostage()) {
                    $price = 0;
                }
            }
        } catch (DeliveryException $ex) {
            return Tlog::getInstance()->error($ex->getMessage());
        }

        return $price;
    }

    /**
     * Obtient les clés de statut des types de livraison.
     *
     * @return array
     */
    public function getDeliveryTypesStatusKeys(): array
    {
        return ChronopostPickupPointConst::getDeliveryTypesStatusKeys();
    }
}
