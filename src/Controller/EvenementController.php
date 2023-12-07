<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {

        $eventPassed = false;

        $events = $evenementRepository->findAll();

        // Iterate through events and add a new property indicating whether the event has occurred
        foreach ($events as $event) {
            $eventDate = $event->getDateEvenementt();
            $currentDate = new \DateTime();
            $eventPassed = $eventDate < $currentDate;
        }
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
            'eventPassed' => $eventPassed
        ]);
    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserInterface $currentUser): Response
    {
        $evenement = new Evenement();

        // Set the entreprise field to the current user's ID
        if ($currentUser instanceof User) {
            $evenement->setEntreprise($currentUser);
        }

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $fileName = md5(uniqid()) . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );

                $evenement->setImageEvenement('uploads/' . $fileName);
            }

            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }


    #[Route('/download-pdf', name: 'app_evenement_download_pdf', methods: ['GET'])]
    public function downloadPdf(EvenementRepository $evenementRepository): Response
    {
        // Logic to generate or fetch the HTML content you want to convert to PDF
        $evenements = $evenementRepository->findAll();
        $htmlContent = $this->renderView('evenement/pdf_template.html.twig', [
            'evenements' => $evenements,
        ]);

        // Generate the PDF file
        $pdfFile = $this->generatePdf($htmlContent);

        // Set up the Response object
        $response = new Response(file_get_contents($pdfFile));
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'inline; filename="downloaded_file.pdf"');

        return $response;
    }

    private function generatePdf($htmlContent): string
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $outputFile = tempnam(sys_get_temp_dir(), 'pdf_');
        file_put_contents($outputFile, $dompdf->output());

        return $outputFile;
    }
    #[Route('/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getid(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/participate', name: 'app_evenement_participate', methods: ['POST'])]
    public function participate(Request $request, int $id, EntityManagerInterface $entityManager, UserInterface $currentUser): Response
    {
        $evenement = $entityManager->getRepository(Evenement::class)->find($id);
        if (!$evenement) {
            throw $this->createNotFoundException('Evenement not found');
        }

        if ($currentUser instanceof User) {
            $evenement->addParticipant($currentUser);
            $currentUser->addParticipatedEvenement($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_show', ['id' => $evenement->getid()]);
    }

}
