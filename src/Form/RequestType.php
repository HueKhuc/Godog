<?php

namespace App\Form;

use App\Entity\Dog;
use App\Entity\Request;
use App\Repository\DogRepository;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $announcement = $options['data']->getAnnouncement();
        $builder
            ->add('dogs', EntityType::class, [
                'class' => Dog::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'query_builder' => function (DogRepository $dogRepository) use ($announcement) {
                    $id = $announcement->getId();
                    return $dogRepository->createQueryBuilder('d')
                                ->join('d.announcement','a')
                                ->where('a.id = :val')
                                ->setParameter('val', $id);
                },
                'by_reference' => false,
            ])
            ->add('messages', CollectionType::class, [
                'entry_type' => MessageType::class,
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
