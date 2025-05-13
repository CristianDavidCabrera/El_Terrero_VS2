<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Club;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/team')]
class TeamController extends AbstractController
{
    #[Route('/', name: 'app_team_index', methods: ['GET'])]
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $this->isGranted('ROLE_ADMIN') ? 
            $teamRepository->findAll() :
            $this->getUser()->getClub()->getTeams()->toArray()
        ]);
    }

    #[Route('/new', name: 'app_team_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $club = $this->isGranted('ROLE_ADMIN') ? $entityManager->getRepository(Club::class)->findAll() :  $this->getUser()->getClub();
        $form = $this->createForm(TeamType::class, $team, [
            'user_club' => $club
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('team/new.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_team_show', methods: ['GET'])]
    public function show($id, EntityManagerInterface $entityManager): Response
    {

        $team = $entityManager->getRepository(Team::class)->find($id);
        return $this->render('team/show.html.twig', [
            'team' => $team
        ]);
    }

    #[Route('/{id}/edit', name: 'app_team_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(TeamType::class, $team, [
            'user_club'=> $entityManager->getRepository(Club::class)->find($team->getIdClub())  
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('team/edit.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_team_delete', methods: ['POST'])]
    public function delete(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
    }



  /* #[IsGranted('ROLE_USER')]  */
   #[Route("/{clubId}", name: 'app_team_showYourTeams', methods: ['GET'])]
  public function showYourTeams(EntityManagerInterface $entityManager, $clubId): Response
  {     
        // Buscar el club por ID
        $club = $entityManager->getRepository(Club::class)->find($clubId);
        
        // Verificar si el club existe
        if (!$club) {
            throw $this->createNotFoundException('Club not found');
        }

        // Obtener todos los equipos del club
        $teams = $club->getTeams();

        // Renderizar la vista con los equipos
        return $this->render('team/showAllTeams.html.twig', [
            'teams' => $teams,
        ]);

  }  




}
