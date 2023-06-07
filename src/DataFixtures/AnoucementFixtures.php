<?php

namespace App\DataFixtures;

use App\Entity\Anoucement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnoucementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $anoucementInfo = [
            [
                'title' => 'Anoucement 1',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-01 15h23',
            ],
            [
                'title' => 'Anoucement 2',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-03 15h42',
            ],
            [
                'title' => 'Anoucement 3',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-05 16h28',
            ],
            [
                'title' => 'Anoucement 4',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnoucement' => '2021-02-07 17h12',
            ],
        ];

        foreach ($anoucementInfo as $info) {

            $anoucement = new Anoucement();
            $anoucement->setTitle($info['title']);
            $anoucement->setInfo($info['info']);
            $anoucement->setDateAnoucement(new \DateTime($info['dateAnoucement']));
        }

        $manager->persist($anoucement);
        $manager->flush();
    }
}