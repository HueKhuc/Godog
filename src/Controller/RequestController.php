<?php

namespace App\Controller;

use App\Entity\Adopter;

use App\Form\MessageType;
use App\Entity\Announcement;
use App\Entity\Message;
use App\Entity\Request as AdoptionRequest;
use App\Form\RequestType;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as PhpRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RequestController extends AbstractController
{
    #[Route('/request/{id}', name: 'app_request_id', requirements: ['id' => "\d+"])]
    #[IsGranted('ROLE_ADOPTER')]
    public function new(
        Announcement $announcement,
        PhpRequest $phpRequest,
        EntityManagerInterface $em,
        AnnouncementRepository $repository,
    ): Response {
        $adopter = $this->getUser();

        $adoptionRequest = new AdoptionRequest();
        /** @var Adopter $adopter */
        $adoptionRequest->setAdopter($adopter);
        $dogs = $announcement->getDogs();
        foreach ($dogs as $dog) {
            $adoptionRequest->addDog($dog);
        }

        $announcement->addRequest($adoptionRequest);

        $message = new Message();
        $message->setUser($adopter);
        $adoptionRequest->addMessage($message);

        $form = $this->createForm(RequestType::class, $adoptionRequest);
        $form->handleRequest($phpRequest);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($adoptionRequest);
            $em->flush();

            $this->addFlash('success', 'Demande envoyé');

            return $this->redirectToRoute('app_request_id', [
                'id' => $announcement->getId(),
            ]);
        }

        return $this->render('request/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/request/{id}/reply', name: 'app_request_reply')]
    public function messageReply (Request $request, int $id, EntityManagerInterface $entityManager): Response 
    {
          // fetch my message sent from database
          $chatMessage = $entityManager->getRepository(Message::class)->find($id);
        dd($chatMessage);
        return $this->render('request/chat.html.twig', [
            'chatMessage' => $chatMessage,
        ]);
    }
}
