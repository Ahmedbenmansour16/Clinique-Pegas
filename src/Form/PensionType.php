<?php

namespace App\Form;

use App\Entity\Pension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PensionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_pension', TextType::class, [
                'label' => 'Nom de la pension',
            ])
            ->add('Prix_pension', TextType::class, [
                'label' => 'Prix de la pension',
            ]);
            // Utilise TextType ici car dans l'entité c’est un string (pas float/money)
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pension::class,
        ]);
    }
}
