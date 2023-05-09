<?php

namespace App\Controller;

use App\Entity\Symfonyproject;
use App\Form\SymfonyprojectType;
use App\Repository\SymfonyprojectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/symfonyproject')]
class SymfonyprojectController extends AbstractController
{
    #[Route('/', name: 'app_symfonyproject_index', methods: ['GET'])]
    public function index(SymfonyprojectRepository $symfonyprojectRepository): Response
    {
        return $this->render('symfonyproject/index.html.twig', [
            'symfonyprojects' => $symfonyprojectRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_symfonyproject_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SymfonyprojectRepository $symfonyprojectRepository): Response
    {
        $symfonyproject = new Symfonyproject();
        $form = $this->createForm(SymfonyprojectType::class, $symfonyproject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symfonyprojectRepository->save($symfonyproject, true);

            return $this->redirectToRoute('app_symfonyproject_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('symfonyproject/new.html.twig', [
            'symfonyproject' => $symfonyproject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_symfonyproject_show', methods: ['GET'])]
    public function show(Symfonyproject $symfonyproject): Response
    {
        return $this->render('symfonyproject/show.html.twig', [
            'symfonyproject' => $symfonyproject,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_symfonyproject_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Symfonyproject $symfonyproject, SymfonyprojectRepository $symfonyprojectRepository): Response
    {
        $form = $this->createForm(SymfonyprojectType::class, $symfonyproject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symfonyprojectRepository->save($symfonyproject, true);

            return $this->redirectToRoute('app_symfonyproject_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('symfonyproject/edit.html.twig', [
            'symfonyproject' => $symfonyproject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_symfonyproject_delete', methods: ['POST'])]
    public function delete(Request $request, Symfonyproject $symfonyproject, SymfonyprojectRepository $symfonyprojectRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$symfonyproject->getId(), $request->request->get('_token'))) {
            $symfonyprojectRepository->remove($symfonyproject, true);
        }

        return $this->redirectToRoute('app_symfonyproject_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
