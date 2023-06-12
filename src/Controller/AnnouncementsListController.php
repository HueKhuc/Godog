<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementsListController extends AbstractController
{
    #[Route('/announcementsList', name: 'app_announcements_list')]
    public function index(AnnouncementRepository $announcementRepository): Response
    {
        $announcements = $announcementRepository->findAll();
        foreach ($announcements as $announcement) {
            $dogs = $announcement->getDogs();
            $photosLinks = [];
            foreach ($dogs as $i => $dog) {
                $photos = $dog->getPictures();
                $links = [];
                foreach ($photos as $key => $photo) {
                    if ($key < 3) {
                        $link = $photo->getLink();
                        $links[$key] = $link;
                    }
                }
                $photosLinks[$i] = $links;
            }
            }
            return $this->render('announcements_list/index.html.twig', [
                'announcements' => $announcements,
                'photosLinks' => $photosLinks,
            ]);
    }
}