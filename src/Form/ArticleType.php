<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Place;
use App\Entity\Porte;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Energie;
use App\Entity\Transmission;
use App\Entity\ArticleVoiture;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class ArticleType extends AbstractType
{

    public function __construct(private ModeleRepository $repoModele){}
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        

        $builder
            ->add('title')
            ->add('description')
            ->add('DescriptionLongue')
            ->add('Annee')
            ->add('km')
            ->add('puissancecv')
            ->add('puissancedin')
            ->add('price')
            ->add('imageFile', VichImageType::class)
            ->add('imageFiled', VichImageType::class)
            ->add('imageFilet', VichImageType::class)
            ->add('transmission', EntityType::class, [
                'class' => Transmission::class,
                'placeholder' => 'transmission',
            ])
            ->add('porte', EntityType::class, [
                'class' => Porte::class,
                'placeholder' => 'Nbr de Porte'
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'placeholder' => 'Nbr de place'
            ])
            ->add('energie', EntityType::class, [
                'class' => Energie::class,
                'placeholder' => 'Energie'
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'placeholder' => 'Type'
            ])
    
            
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nom',
                'placeholder' => 'Marque',
                'query_builder' => function(MarqueRepository $repoMarque) {
                    return $repoMarque->findALLOrderedByAscNomQueryBuilder();
    
                }
            ])
            ->add('modele', EntityType::class, [
                    'class' => Modele::class,
                    'choice_label' => 'name',
                    'placeholder' => 'Modele',
                    
                ]);
            
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
