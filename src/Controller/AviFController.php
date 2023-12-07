<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\Avis1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avi/f')]
class AviFController extends AbstractController
{
    #[Route('/', name: 'app_avi_f_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $avis = $entityManager
            ->getRepository(Avis::class)
            ->findAll();

        return $this->render('avi_f/index.html.twig', [
            'avis' => $avis,
        ]);
    }

    #[Route('/new', name: 'app_avi_f_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avi = new Avis();
        $form = $this->createForm(Avis1Type::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('app_avi_f_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avi_f/new.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/{idavis}', name: 'app_avi_f_show', methods: ['GET'])]
    public function show(Avis $avi): Response
    {
        return $this->render('avi_f/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    #[Route('/{idavis}/edit', name: 'app_avi_f_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Avis1Type::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avi_f_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avi_f/edit.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/{idavis}', name: 'app_avi_f_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getIdavis(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avi_f_index', [], Response::HTTP_SEE_OTHER);
    }
}
