<?php

namespace App\Shipping\Calculator;

use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;

final class WeightBasedCalculator implements CalculatorInterface
{
    public const TYPE = 'weight_based';

    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        $order = $subject->getOrder();
        $totalWeight = 0.0;

        foreach ($order->getItems() as $item) {
            $variant = $item->getVariant();
            $weight = (float) ($variant->getWeight() ?? 0); // kg
            $totalWeight += $weight * $item->getQuantity();
        }

        foreach ($configuration['tiers'] ?? [] as $tier) {
            $min = (float) ($tier['min'] ?? 0);
            $max = (float) ($tier['max'] ?? PHP_FLOAT_MAX);
            $amount = (int) ($tier['amount'] ?? 0); // MGA (entier)
            if ($totalWeight >= $min && $totalWeight < $max) {
                return $amount;
            }
        }

        return (int) ($configuration['default_amount'] ?? 0);
    }

    public function getType(): string
    {
        return self::TYPE;
    }
}
