<?php

namespace App\DataFixtures;

use App\Entity\Announcement;
use App\Repository\BreederRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnnouncementFixtures extends Fixture implements DependentFixtureInterface
{
    protected BreederRepository $breederRepository;

    public function __construct(BreederRepository $breederRepository)
    {
        $this->breederRepository = $breederRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $announcementInfo = [
            [
                'title' => 'announcement 1',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnnouncement' => '2021-02-01 15:23',
            ],
            [
                'title' => 'announcement 2',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnnouncement' => '2021-02-03 15:42',
            ],
            [
                'title' => 'announcement 3',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnnouncement' => '2021-02-05 16:28',
            ],
            [
                'title' => 'announcement 4',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnnouncement' => '2021-02-07 17:12',
            ],
            [
                'title' => 'Announcement 5',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnnouncement' => '2021-03-09 19:02',
            ],
            [
                'title' => 'Announcement 6',
                'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec velit',
                'dateAnnouncement' => '2021-03-11 18:10',
            ],
        ];

        $breeders = $this->breederRepository->findAll();

        foreach ($announcementInfo as $info) {
            $announcement = new announcement();
            $announcement->setTitle($info['title']);
            $announcement->setInfo($info['info']);
            $nb = mt_rand(0, 1000000);
            $date = new \DateTime('-' . $nb . ' minutes');
            $announcement->setDateAnnouncement($date);
            $index = mt_rand(0, count($breeders) - 1);

            $announcement->setBreeder($breeders[$index]);

            $manager->persist($announcement);
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
