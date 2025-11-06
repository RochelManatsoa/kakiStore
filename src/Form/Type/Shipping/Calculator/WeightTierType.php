<?php

namespace App\Form\Type\Shipping\Calculator;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

final class WeightTierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('min', NumberType::class, ['label' => 'Poids min (kg)'])
            ->add('max', NumberType::class, ['label' => 'Poids max (kg)'])
            ->add('amount', IntegerType::class, ['label' => 'Prix (MGA)']);
    }
}
