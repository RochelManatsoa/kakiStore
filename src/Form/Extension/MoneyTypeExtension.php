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
        // On indique à Symfony qu'on étend le MoneyType de Sylius
        return [MoneyType::class];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // On modifie le "divisor" UNIQUEMENT pour la devise MGA
        $resolver->setNormalizer('divisor', function (Options $options, $value) {
            if (($options['currency'] ?? null) === 'MGA') {
                // Pas de x100 : 1 ariary saisi = 1 ariary stocké
                return 1;
            }

            // Pour toutes les autres devises, on garde le comportement Sylius
            return $value;
        });
    }
}
