<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\Entreprise1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EntrepriseRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



#[Route('/entreprise')]
class EntrepriseController extends AbstractController
{

    #[Route('/', name: 'app_entreprise_index', methods: ['GET'])]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('Back/entreprise/index.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_entreprise_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $entreprise = new Entreprise();
        $form = $this->createForm(Entreprise1Type::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('app_entreprise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/entreprise/new.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form,
        ]);
    }
    #[ParamConverter("entreprise")]

    #[Route('/{idEntreprise}', name: 'app_entreprise_show', methods: ['GET'])]
    public function show(Entreprise $entreprise): Response
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }
    #[ParamConverter("entreprise")]

    #[Route('/{idEntreprise}/edit', name: 'app_entreprise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entreprise $entreprise, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Entreprise1Type::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entreprise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form,
        ]);
    }
    #[ParamConverter("entreprise")]

    #[Route('/{idEntreprise}', name: 'app_entreprise_delete', methods: ['POST'])]
    public function delete(Request $request, Entreprise $entreprise, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $entreprise->getIdEntreprise(), $request->request->get('_token'))) {
            $entityManager->remove($entreprise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entreprise_index', [], Response::HTTP_SEE_OTHER);
    }
    //entreprise frint 
    #[ParamConverter("entreprise")]
    #[Route('/profileentr/{idEntreprise}', name: 'app_entreprise_profile', methods: ['GET'])]
    public function profileentr(Entreprise $entreprise): Response
    {
        return $this->render('Front/entreprise/entrHome.html.twig', [
            'entreprise' => $entreprise
        ]);
    }
}
