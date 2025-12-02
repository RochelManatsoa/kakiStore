<?php

declare(strict_types=1);

namespace App\Form\Extension;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class MoneyTypeExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [MoneyType::class];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setNormalizer('divisor', function (Options $options, $value) {
            if (($options['currency'] ?? null) === 'MGA') {
                // 1 ariary saisi = 1 ariary stocké
                return 1;
            }

            return $value; // autres devises inchangées
        });
    }
}
