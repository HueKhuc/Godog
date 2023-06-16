<?php

namespace App\Form;

use App\Entity\Dog;
use App\Entity\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dogs', EntityType::class, [
                'class' => Dog::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ])
            ->add('messages', CollectionType::class, [
                'entry_type' => MessageType::class,
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Request::class,
        ]);
    }
}
