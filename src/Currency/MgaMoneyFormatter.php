<?php

declare(strict_types=1);

namespace App\Currency;

use Sylius\Bundle\MoneyBundle\Formatter\MoneyFormatterInterface;

final class MgaMoneyFormatter implements MoneyFormatterInterface
{
    public function __construct(
        private MoneyFormatterInterface $inner,
    ) {
    }

    public function format(int $amount, string $currencyCode, ?string $localeCode = null): string
    {
        // Pour les autres devises, on laisse Sylius faire son travail
        if ($currencyCode !== 'MGA') {
            return $this->inner->format($amount, $currencyCode, $localeCode);
        }

        // Pour MGA : on considère que $amount est déjà en ariary "entier"
        // (puisqu'on a mis divisor=1 dans MoneyTypeExtension)

        $formatted = number_format($amount, 0, ',', ' ');

        return sprintf('%s %s', $formatted, $currencyCode);
    }
}
