<?php

namespace App\Controller;

use App\Entity\Projectsemma;
use App\Form\ProjectsemmaType;
use App\Repository\ProjectsemmaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/apiprojectsemma')]
class ApiController extends AbstractController
{
    #[Route('/list', name: 'app_apiprojectsemma_index', methods: ['GET'])]
    public function index(ProjectsemmaRepository $projectsemmaRepository): Response
    {
        $projectsemma = $projectsemmaRepository->findAll();

        $data = [];

        foreach ($projectsemma as $p) {
            $data[] = [
                'id' => $p->getId(),
                'project_name' => $p->getProjectName(),
                'date' => $p->getDate(),
                'used_technology' => $p->getUsedTechnology(),
                'image' => $p->getImage(),
            ];
        }
        //dump($data);die; 
        //return $this->json($data);
        return $this->json($data, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }
}