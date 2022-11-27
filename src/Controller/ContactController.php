<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use App\Repository\CandidatsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Swift_Mailer;
use Swift_Message;
use Swift_Attachment;

use Dompdf\Dompdf;
use Dompdf\Options;

class ContactController extends AbstractController
{
   
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, \Swift_Mailer $mailer,CandidatsRepository $candidatsRepository)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            
           $pdfOptions = new Options();
            $candidats = $candidatsRepository->findAll();
           $dompdf = new Dompdf($pdfOptions);
           $html = $this->renderView('candidats/print.html.twig', [
             'Candidats' => $candidats ]);
           $dompdf->loadHtml($html);
    $dompdf->render();
   $output = $dompdf->output();

    $message = (new \Swift_Message('Nouveau Contact'))
    ->setFrom('chedya.khichi@esprit.tn')
    ->setTo('chedya.khichi@esprit.tn')
    ->setsubject('Les demandes !');
    $attachement = new \Swift_Attachment($output, "Liste des candidats.pdf", 'application/pdf' );
   $message->attach($attachement);

        $mailer->send($message);

            $this->addFlash('success', 'Vore message a été envoyé');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}