<?php

namespace App\Form;

use App\Entity\Cheval;
use App\Entity\Dicipline;
use App\Entity\Nouriture;
use App\Entity\Pension;
use App\Entity\Proprietaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;




class ChevalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('photo', FileType::class, [
            'label' => 'Photo du cheval',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '2M',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ],
                    'mimeTypesMessage' => 'Merci de télécharger une image valide (JPG, PNG, WEBP)',
                ])
            ],
        ])
        
            ->add('numPuce', TextType::class, [
                'label' => 'Numéro de puce',
                'attr' => ['placeholder' => 'Ex: 123456789']
            ])
            ->add('nomCheval', TextType::class, [
                'label' => 'Nom du cheval'
            ])
            ->add('dateNaisse', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text'
            ])
            ->add('genre', TextType::class, [
                'label' => 'Genre',
                'attr' => ['placeholder' => 'Mâle / Femelle']
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaire::class,
                'choice_label' => 'nomProprietaire',
                'label' => 'Propriétaire',
                'attr' => ['class' => 'styled-select']
            ])
            ->add('dicipline', EntityType::class, [
                'class' => Dicipline::class,
                'choice_label' => 'nomDicipline',
                'label' => 'Dicipline',
                'attr' => ['class' => 'styled-select']
            ])
            ->add('pension', EntityType::class, [
                'class' => Pension::class,
                'choice_label' => 'nomPension',
                'label' => 'Pension'
            ])
            ->add('dateEntree', DateType::class, [
                'label' => 'Date d\'entrée',
                'widget' => 'single_text'
            ])
            ->add('nourriture', EntityType::class, [
                'class' => Nouriture::class,
                'choice_label' => 'nomNouriture',
                'label' => 'Nourriture'
            ])
            ->add('paye', IntegerType::class, [
                'label' => 'Montant payé (€)'
            ])
         
            ->add('noteCheval', TextareaType::class, [
                'label' => 'Note sur le cheval',
                'required' => false,
                'attr' => ['rows' => 4]
            ])
            ->add('rapportCheval', FileType::class, [
                'label' => 'Rapport du Cheval (Word)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader un fichier Word valide (.doc ou .docx)',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cheval::class,
        ]);
    }
}