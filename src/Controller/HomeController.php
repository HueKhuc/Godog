<?php

namespace App\Controller;

use App\Repository\AnnouncementRepository;
use App\Repository\BreederRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homePage', )]
    public function home(BreederRepository $breederRepository, AnnouncementRepository $announcementRepository): Response
    {
        $breeders = $breederRepository->findByBreederHome();
        $announcements = $announcementRepository->showAnnouncementList();

        return $this->render('home/index.html.twig', [
            'breeders' => $breeders,
            'announcements' => $announcements,
        ]);
    }
}
