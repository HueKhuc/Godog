<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\BreederType;
use App\Repository\AnnouncementRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BreederController extends AbstractController
{
    #[Route('/breeder', name: 'app_breeder')]
    #[IsGranted('ROLE_BREEDER')]
    public function modifyBreed(
        Request $request,
        EntityManagerInterface $entityManager,
        AnnouncementRepository $announcementRepository,
        MessageRepository $messageRepository,
    ): Response {
        /** @var \App\Entity\Breeder $breeder  */
        $breeder = $this->getUser();

        // fetch messages
        $messages = $messageRepository->showRecentMessages($breeder);

        // to get messages
        // $breederMessages = $persistentCollection->getValues();

        // fetch breeders announcements  
        $breederAnnouncements = $breeder->getAnnouncements();
        // $breederAnnouncements = $announcementRepository->findBy(['breeder' => $breeder, ]);


        // for updating the breeder info
        $form = $this->createForm(BreederType::class, $breeder, );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données du formulaire
            $entityManager->persist($breeder);
            $entityManager->flush();
            $this->addFlash('success', 'data inserted');
            return $this->redirectToRoute("app_breeder");
        }
        // dd($breederAnnouncements);
        return $this->render('breeder/index.html.twig', [
            'form' => $form->createView(),
            'breederAnnouncements' => $breederAnnouncements,
            'messages' => $messages,
            // 'breederMessages' => $breederMessages,
        ]);

    }
}