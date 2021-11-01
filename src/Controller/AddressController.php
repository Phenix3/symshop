<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/address", name="address_")
 */
class AddressController extends BaseController
{
    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Address $address, Request $request): Response
    {
        $addressForm = $this->createForm(AddressType::class, $address, [
            'expaded_civility' => false
        ]);
        $addressForm->handleRequest($request);

        if ($addressForm->isSubmitted() && $addressForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash('success', 'alerts.address_updated');

            return $this->redirectToRoute('account_index');
        }

        return $this->render('address/edit.html.twig', [
            'addressForm' => $addressForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(Address $address, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $address->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($address);
            $manager->flush();
        }

        return $this->redirectToRoute('account_addresses');
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $address = new Address();
        $addressForm = $this->createForm(AddressType::class, $address);
        $addressForm->handleRequest($request);

        if ($addressForm->isSubmitted() && $addressForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($address);
            $manager->flush();

            $this->addFlash('success', 'alerts.address_created');
            return $this->redirectToRoute('account_addresses');
        }

        return $this->renderForm('address/new.html.twig', compact('addressForm'));
    }
}
