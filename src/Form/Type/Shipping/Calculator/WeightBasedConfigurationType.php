<?php

namespace App\Form\Type\Shipping\Calculator;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

final class WeightBasedConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tiers', CollectionType::class, [
                'entry_type'   => WeightTierType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => 'Paliers de poids',
            ])
            ->add('default_amount', IntegerType::class, [
                'required' => false,
                'label'    => 'Prix par défaut (MGA) si aucun palier ne matche',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'app_shipping_calculator_weight_based';
    }
}
