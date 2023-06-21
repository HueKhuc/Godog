<?php

namespace App\Controller;


use App\Entity\Announcement;
use App\Entity\Breeder;
use App\Form\AnnouncementModificationType;
use App\Repository\AnnouncementRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AnnouncementModificationController extends AbstractController
{
    #[Route('/announcement/new', name: 'app_announcement_create')]
    #[Route('/announcementModification/{id}', name: 'app_announcement_modification', requirements: ['id' => "\d+"])]
    #[IsGranted('ROLE_BREEDER')]
    public function index(Request $request, AnnouncementRepository $repository, ?Announcement $announcement = null): Response
    {
        if (is_null($announcement)) {
            $announcement = new Announcement();
            /** @var Breeder $breeder */
            $breeder = $this->getUser();
            $announcement->setBreeder($breeder);
        }
        $form = $this->createForm(AnnouncementModificationType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($announcement, true);
            $this->addFlash('success', 'Announcement created !');
            return $this->redirectToRoute('app_breeder');
        }

        return $this->render('announcement_modification/index.html.twig', [

            'form' => $form->createView(),
        ]);
    }
}