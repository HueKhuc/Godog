<?php

namespace App\Form;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementModificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title', TextType::class,
                [
                    'label' => 'title',
                    'required' => true,
                ]
            )
            ->add(
                'info', TextType::class,
                [
                    'label' => 'info',
                    'required' => true,
                ]
            )
            ->add(
                'dogs', CollectionType::class,
                [
                    'entry_type' => DogType::class,
                    'prototype_name' => '__dogs__',
                    'label' => 'dogs',
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
            'data_class' => Announcement::class,
        ]);
    }
}
