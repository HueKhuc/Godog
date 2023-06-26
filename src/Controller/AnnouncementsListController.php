<?php

namespace App\Controller;

use App\Form\AnnouncementsFilterType;
use App\Form\Filter\AnnouncementsFilter;
use App\Repository\AnnouncementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementsListController extends AbstractController
{
    #[Route('/announcementsList', name: 'app_announcements_list')]
    public function index(AnnouncementRepository $announcementRepository, Request $request): Response
    {
        $filter = new AnnouncementsFilter();
        $form = $this->createForm(AnnouncementsFilterType::class, $filter);
        $form->handleRequest($request);

        $announcements = $announcementRepository->findByFilter($filter);

        return $this->render('announcements_list/index.html.twig', [
            'announcements' => $announcements,
            'form' => $form->createView(),
        ]);
    }
}
