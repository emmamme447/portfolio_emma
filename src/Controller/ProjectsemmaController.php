<?php

namespace App\Controller;

use App\Entity\Projectsemma;
use App\Form\ProjectsemmaType;
use App\Repository\ProjectsemmaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projectsemma')]
class ProjectsemmaController extends AbstractController
{
    #[Route('/', name: 'app_projectsemma_index', methods: ['GET'])]
    public function index(ProjectsemmaRepository $projectsemmaRepository): Response
    {
        return $this->render('projectsemma/index.html.twig', [
            'projectsemmas' => $projectsemmaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_projectsemma_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProjectsemmaRepository $projectsemmaRepository): Response
    {
        $projectsemma = new Projectsemma();
        $form = $this->createForm(ProjectsemmaType::class, $projectsemma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectsemmaRepository->save($projectsemma, true);

            return $this->redirectToRoute('app_projectsemma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('projectsemma/new.html.twig', [
            'projectsemma' => $projectsemma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projectsemma_show', methods: ['GET'])]
    public function show(Projectsemma $projectsemma): Response
    {
        return $this->render('projectsemma/show.html.twig', [
            'projectsemma' => $projectsemma,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projectsemma_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projectsemma $projectsemma, ProjectsemmaRepository $projectsemmaRepository): Response
    {
        $form = $this->createForm(ProjectsemmaType::class, $projectsemma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectsemmaRepository->save($projectsemma, true);

            return $this->redirectToRoute('app_projectsemma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('projectsemma/edit.html.twig', [
            'projectsemma' => $projectsemma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projectsemma_delete', methods: ['POST'])]
    public function delete(Request $request, Projectsemma $projectsemma, ProjectsemmaRepository $projectsemmaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projectsemma->getId(), $request->request->get('_token'))) {
            $projectsemmaRepository->remove($projectsemma, true);
        }

        return $this->redirectToRoute('app_projectsemma_index', [], Response::HTTP_SEE_OTHER);
    }
}
