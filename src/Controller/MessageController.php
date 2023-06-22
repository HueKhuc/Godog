<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Request;
use App\Form\MessageType;
use App\Repository\AnnouncementRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/request/{id}/reply', name: 'reply')]
    public function reply(
        HttpRequest $httpRequest,
        Request $request,
        MessageRepository $messageRepository,
        EntityManagerInterface $em
    ): Response {
        /** @var \App\Entity\Breeder $breeder  */
        $breeder = $this->getUser();
        $message = new Message();
        $message->setUser($breeder);
        $message->setRequest($request);

        $form = $this->createForm(MessageType::class, $message, [
            'method' => 'POST',
            // 'action' => $this->generateUrl('reply'),
        ]);
        
        $form->handleRequest($httpRequest);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($message);
            $em->flush();
            
            $this->addFlash('success', 'Message sent');

            return $this->redirectToRoute('reply');
        }
        return $this->render('message/index.html.twig', [
            'request' => $request,
            'form' => $form->createView(),
        ]);
    }
}