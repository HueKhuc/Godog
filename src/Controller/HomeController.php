<?php
namespace App\Controller;

use App\Repository\AnoucementRepository;
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
    
    // public function anoucement(AnoucementRepository $anoucementRepository): Response
    // {
    //     $anoucements = $anoucementRepository->findAll();
    //     $brans = $anoucementRepository->findAllBran();

    //     return $this->render('home/index.html.twig', [
    //         'anoucements' => $anoucements,
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