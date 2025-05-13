<?php
// src/Controller/Api/ClubController.php

namespace App\Controller\Api;

use App\Repository\ClubRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/clubs')]
class ClubController extends AbstractController
{
    #[Route('', name: 'api_club_index', methods: ['GET'])]
    public function index(ClubRepository $clubRepository): JsonResponse
    {
        // Recupera todos los clubes
        $clubs = $clubRepository->findAll();

        // Mapear la entidad a un formato adecuado para JSON
        $data = [];
        foreach ($clubs as $club) {
            $data[] = [
                'id' => $club->getId(),
                'name' => $club->getName(),
                'island' => $club->getIsland(),
            ];
        }

        // Devolver los datos en formato JSON
        return new JsonResponse($data);
    }
}
