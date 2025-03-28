<?php

namespace App\Form;

use App\Entity\Proprietaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprietaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_proprietaire', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('Prenom_proprietaire', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('Cin_proprietaire', IntegerType::class, [
                'label' => 'CIN'
            ])
            ->add('Num_tel', IntegerType::class, [
                'label' => 'Téléphone'
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proprietaire::class,
        ]);
    }
}
