<?php

namespace App\Controller;


use App\Form\AdopterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdopterController extends AbstractController
{
    #[Route('/adopter', name: 'app_adopter')]
#[ IsGranted('ROLE_ADOPTER')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $adopter = $this->getUser();
        $form = $this->createForm(AdopterType::class, $adopter);
        // $message = $this->createForm(Request::class, $adopter);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l’entité manager qui va nous permettre de sa
            $em->persist($adopter);
            $em->flush();

            $this->addFlash('success', 'Data inserted');
            return $this->redirectToRoute('app_adopter');
        }
        return $this->render('adopter/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}