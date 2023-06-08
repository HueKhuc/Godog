<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementsListController extends AbstractController
{
    #[Route('/announcementsList', name: 'app_announcements_list')]
    public function index(): Response
    {
        return $this->render('announcements_list/index.html.twig', [
            'controller_name' => 'AnnouncementsListController',
        ]);
    }
}
