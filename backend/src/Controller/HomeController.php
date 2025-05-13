<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\ClubRepository;
use App\Repository\GameRepository;
use App\Repository\ScoreRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function success (ClubRepository $clubes, TeamRepository $teams ,GameRepository $games, ScoreRepository $scores): Response
    {
         return $this->render('home.html.twig', [
            'clubes' => $clubes->findAll(),
            'teams' => $teams->findAll(), 
            'games' => $games->findAll(),
            'scores'=> $scores->findAll()
     ]);
    }

    #[Route('/dashboar_user', name: 'dashboard_user')]
    public function dashboarUser () {
       return $this->render('dashboardUser.html.twig');
    }
    
    #[Route('/dashboar_admin', name: 'dashboard_admin')]
    public function dashboarAdmin () {
       return $this->render('dashboardAdmin.html.twig');
    }

}