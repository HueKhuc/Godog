<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Request as AdoptionRequest;
use App\Form\RequestType;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as PhpRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RequestController extends AbstractController
{
    #[Route('/request/{id}', name: 'app_request_id', requirements: ['id' => "\d+"])]
    #[IsGranted('ROLE_ADOPTER')]
    public function new(
        int $id,
        PhpRequest $phpRequest,
        EntityManagerInterface $em,
        AnnouncementRepository $repository,
    ): Response {
        $adopter = $this->getUser();
        $announcement = $repository->find($id);

        $adoptionRequest = new AdoptionRequest();
        // $adoptionRequest->setAnnouncement($announcement);
        $adoptionRequest->setAdopter($adopter);

        // $adopter->addRequest($adoptionRequest);
        $announcement->addRequest($adoptionRequest);

        $dogs = $announcement->getDogs();

        $message = new Message();
        $message->setUser($adopter);
        // $message->setUser($this->getUser());
        $adoptionRequest->addMessage($message);

        $form = $this->createForm(RequestType::class, $adoptionRequest);
        $form->handleRequest($phpRequest);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($adoptionRequest);
            $em->flush();

            $this->addFlash('success', 'Donnée insérée');

            return $this->redirectToRoute('app_request_id', [
                'id' => $id,
            ]);
        }

        return $this->render('request/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}