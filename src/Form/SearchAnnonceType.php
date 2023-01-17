<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Type;
use App\Entity\Place;
use App\Entity\Porte;
use App\Entity\Energie;
use App\Entity\Transmission;
use App\Entity\ArticleVoiture;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class SearchAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mots', SearchType::class, [
                'label' => false,
                'attr'=> [
                    'class' => 'form-control',
                    'placeholder' => 'Search'
                ],
                'required' => false
            ])
            ->add('Recherche', SubmitType::class)

            ->add('transmission', EntityType::class, [
                'class' => Transmission::class,
                'placeholder' => 'transmission',
                'required' => false
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'required' => false,
                'placeholder' => 'Nbr de place'
            ])
            ->add('energie', EntityType::class, [
                'class' => Energie::class,
                'required' => false,
                'placeholder' => 'Energie'
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'required' => false,
                'placeholder' => 'Type'
            ])
                
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Modele',
            ])

            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'required' => false,
                'choice_label' => 'nom',
                'placeholder' => 'Marque',
                'query_builder' => function(MarqueRepository $repoMarque) {
                    return $repoMarque->findALLOrderedByAscNomQueryBuilder();
    
                }
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
