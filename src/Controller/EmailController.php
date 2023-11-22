<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Form\EmailFormType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Psr\Log\LoggerInterface;

#[Route('/email')]
class EmailController extends AbstractController
{
    #[Route('/send', name: 'app_send_email', methods: ['GET', 'POST'])]
    public function sendEmail(
        Request $request,
        MailerInterface $mailer,
        FlashBagInterface $flashBag,
        LoggerInterface $logger
    ): Response {
        $form = $this->createForm(EmailFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['senderEmail'])
                ->to('slimi.amal@esprit.tn') // Replace with your recipient email
                ->subject($data['subject'])
                ->text($data['content']);

            try {
                $mailer->send($email);
                $flashBag->add('success', 'Email sent successfully!');
                $logger->info('Email sent successfully.');
            } catch (\Exception $e) {
                $flashBag->add('error', 'Failed to send email.');
                $logger->error('Error sending email: ' . $e->getMessage());
            }

            return $this->redirectToRoute('app_post_index'); // Redirect to some page after sending email
        }

        return $this->render('email/send.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}