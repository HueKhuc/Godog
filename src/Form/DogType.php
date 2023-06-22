<?php

namespace App\Form;

use App\Entity\Dog;
use App\Entity\Race;
use App\Form\PictureType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('background')
            ->add('description')
            ->add('isTolerant')
            ->add('isLof')
            ->add('isAdopted')
            ->add(
                'races', EntityType::class,
                [
                    'choice_label' => 'name',
                    'class' => Race::class,
                    'multiple' => true,
                    'expanded' => true,
                ]
            )
            ->add(
                'pictures', CollectionType::class,
                [
                    'entry_type' => PictureType::class,
                    'label' => 'Images',
                    'allow_add' => true,
                    'by_reference' => false,
                    'entry_options' => ['label' => false],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}