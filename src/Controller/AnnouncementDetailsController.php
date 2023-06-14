<?php

namespace App\Controller;

use App\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementDetailsController extends AbstractController
{
    #[Route('/announcementDetails/{id}', name: 'app_announcement_id', requirements: ['id' => "\d+"])]
    public function index(Announcement $announcement): Response
    {
        return $this->render('announcement_details/index.html.twig', [
            'announcement' => $announcement,
        ]);
    }
}