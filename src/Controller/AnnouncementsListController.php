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
        return $this->render('announcements_list/index.html.twig', [
            'announcements' => $announcements,
        ]);
    }
}