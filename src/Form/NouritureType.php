<?php

namespace App\Form;

use App\Entity\Nouriture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NouritureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_nouriture', TextType::class, [
                'label' => 'Nom de la nourriture',
            ])
            ->add('Stock_dispo', IntegerType::class, [
                'label' => 'Stock disponible',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nouriture::class,
        ]);
    }
}
