<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TrickRepository $trickRepository): Response
    {
        // On récupère tous les tricks, triés par date de création (du plus récent au plus ancien)
        $tricks = $trickRepository->findAllWithRelations();

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }

    #[Route('/trick/{slug}', name: 'app_trick_show')]
    public function show(string $slug, TrickRepository $trickRepository): Response
    {
        // On récupère le trick avec son slug
        $trick = $trickRepository->findOneBy(['slug' => $slug]);

        // Si le trick n'existe pas, on lance une erreur 404
        if (!$trick) {
            throw $this->createNotFoundException('Cette figure n\'existe pas.');
        }

        return $this->render('home/show.html.twig', [
            'trick' => $trick,
        ]);
    }
}
