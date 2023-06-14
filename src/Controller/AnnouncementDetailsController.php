<?php

namespace App\Controller;

use App\Repository\AnnouncementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class AnnouncementDetailsController extends AbstractController
{
    #[Route('/announcementDetails/{id}', name: 'app_announcement_id', requirements: ["id" => "\d+"])]
    public function index(int $id, AnnouncementRepository $announcementRepository): Response
    {
        $announcement = $announcementRepository->findOneById($id);
        return $this->render('announcement_details/index.html.twig', [
            'announcement' => $announcement,
        ]);

    }
}
