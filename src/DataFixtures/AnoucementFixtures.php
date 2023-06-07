<?php

namespace App\DataFixtures;

use App\Entity\Anoucement;

use App\Repository\BreederRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnoucementFixtures extends Fixture implements DependentFixtureInterface
{
    protected BreederRepository $breederRepository;

    public function __construct(BreederRepository $breederRepository)
    {
        $this->breederRepository = $breederRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $anoucementInfo = [
            [
                'title' => 'Anoucement 1',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-01 15:23',
            ],
            [
                'title' => 'Anoucement 2',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-03 15:42',
            ],
            [
                'title' => 'Anoucement 3',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-05 16:28',
            ],
            [
                'title' => 'Anoucement 4',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-07 17:12',
            ],
        ];

        $breeders = $this->breederRepository->findAll();

        foreach ($anoucementInfo as $info) {

            $anoucement = new Anoucement();
            $anoucement->setTitle($info['title']);
            $anoucement->setInfo($info['info']);
            $nb = mt_rand(0, 1000000);
            $date = new DateTime('-'.$nb.' minutes');
            $anoucement->setDateAnoucement($date);
            $index = mt_rand(0, count($breeders) - 1);

            $anoucement->setBreeder($breeders[$index]);



            $manager->persist($anoucement);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}