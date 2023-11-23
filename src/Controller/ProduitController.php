<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\VehiculeRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Produit;
use App\Entity\Vehicule;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use App\Service\VehiculeManager;
use App\Form\ProductSearchType;
use App\Repository\CategorieRepository;
use App\Repository\EnergieRepository;

class ProduitController extends AbstractController{

    
    #[Route('/showProduit', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository,VehiculeRepository $vehiculeRepository): Response
    {
        return $this->render('Produit/index.html.twig', [
            'results' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/findprod', name: 'app_produit_find', methods: ['GET', 'POST'])]
    public function search(ProduitRepository $productRepository, Request $request, EnergieRepository $energieRepository, CategorieRepository $categorieRepository ): Response
    {
        $form = $this->createForm(ProductSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $results = $productRepository->searchByCriteria($data['category'], $data['energie']);
        } else {
            $results = "plat";
        }

        return $this->render('Produit/search.html.twig', [
            'form' => $form->createView(),
            'Categories' =>$categorieRepository ->findAll() ,
            'Energies' =>$energieRepository ->findAll() ,
            'results' => $results,
        ]);
    }

    #[Route('/newprod', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $manager): Response{
    $produit = new Produit();
    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($produit);
        $entityManager->flush();

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('produit/new.html.twig', [
        'produit' => $produit,
        'form' => $form,
    ]);
    }


    #[Route('/{idProduit}/editprod', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    #[ParamConverter("produit")]
    public function edit(Request $request, Produit $idProduit, EntityManagerInterface $entityManager): Response
    {   
        $form = $this->createForm(ProduitType::class, $idProduit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Produit/_edit.html.twig', [
            'produit' => $idProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{idProduit}/deleteprod', name: 'app_produit_delete', methods: ['POST'])]
    #[ParamConverter("produit")]
    public function delete(Request $request, Produit $idProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $idProduit->getIdProduit(), $request->request->get('_token'))) {
            $entityManager->remove($idProduit);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
