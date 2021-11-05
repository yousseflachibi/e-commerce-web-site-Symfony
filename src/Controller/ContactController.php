<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\EmailModel;
use App\Services\EmailSender;
use App\Repository\ContactRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    private $mailer;

   

    public function __construct(MailerInterface $mailer)
    {
       
        $this->mailer = $mailer;
        
    }
   
    /**
     * @Route("/", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoi d'email
                $message = "Bonjour admin vous avez un nouveau message ";
                $Mailadmin ="salaheddine.raiss@gmail.com";
                $mailclient = "achraftk76@gmail.com";

                $mail = (new Email())
                ->from($mailclient)
                ->to($Mailadmin)
                ->subject("page contact")
                ->text($message);
                $this->mailer->send($mail);
            //$sendmailcontact->EnvoieMail();

            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            $this->addFlash('contact_success', 'Votre message a été envoyé. Un conseiller vous répondra très rapidement!');
        }

        if($form->isSubmitted() && !$form->isValid()){
            $this->addFlash('contact_error', 'Le formulaire contient des erreurs. Veuillez corriger et réessayer.');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

}
