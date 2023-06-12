<?php
namespace App\Controller;

use App\Repository\announcementRepository;
use App\Repository\BreederRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'homePage')]
    // public function homePage(): Response
    // {
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }
    #[Route('/', name: 'homePage')]
    // public function breeder(BreederRepository $breederRepository): Response
    // {
    //     $breeders = $breederRepository->findAll();

    //     return $this->render('home/index.html.twig', [
    //         'breeders' => $breeders,

    //     ]);
    // }  

    // public function announcement(announcementRepository $announcementRepository): Response
    // {
    //     $announcements = $announcementRepository->findAll();
    //     $brans = $announcementRepository->findAllBran();

    //     return $this->render('home/index.html.twig', [
    //         'announcements' => $announcements,
    //         'brans' => $brans,
    //     ]);
    // } 

    public function breeder(BreederRepository $breederRepository): Response
    {
        $breeders = $breederRepository->findByBreederHome();

        return $this->render('home/index.html.twig', [
            'breeders' => $breeders,
        ]);
    }
}