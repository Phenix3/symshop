<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact", name="contact_")
 */
class ContactController extends BaseController
{
    /**
     * @Route("", name="new")
     */
    public function new(Request $request): Response
    {
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);
        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            // TODO: Traitement du formulaire et envoi du message directement sur la boite mail.

            $this->addFlash('success', 'alerts.contact_created');
            return $this->redirectToRoute('home');        
        }

        return $this->renderForm('contact/new.html.twig', compact('contactForm'));
    }
}
