<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\UserType;
use App\Repository\AddressRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account", name="account_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class AccountController extends BaseController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/addresses", name="addresses")
     *
     * @return Response
     */
    public function addresses(AddressRepository $addressRepository): Response
    {
        $addresses = $addressRepository->findAllForUser($this->getUser());

        return $this->render('account/addresses.html.twig', \compact('addresses'));
    }


    /**
     * @Route("/profile/edit", name="profile_edit")
     *
     * @return Response
     */
    public function profileEdit(Request $request): Response
    {
        $user = $this->getUser();
        $profileForm = $this->createForm(UserType::class, $user);

        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'alerts.profile_updated');

            return $this->redirectToRoute('account_index');
        }

        return $this->render('account/profile_edit.html.twig', [
            'profileForm' => $profileForm->createView()
        ]);
    }

    /**
     * @Route("/orders", name="orders", methods={"GET"})
     *
     * @return Response
     */
    public function orders(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findAllForUser($this->getUser());

        return $this->render('account/orders.html.twig', compact('orders'));
    }

    /**
     * @Route("/excerpt", name="excerpt", methods={"GET"})
     *
     * @return Response
     */
    public function excerpt(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $this->denyAccessUnlessGranted('USER_SHOW', $user);
        $user = $userRepository->findForExcerpt($user);
        
        return $this->render('account/excerpt.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/orders/{reference}", name="orders_show", methods={"GET"})
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order): Response
    {
        $this->denyAccessUnlessGranted('ORDER_SHOW', $order);

        return $this->render('account/order/show.html.twig', compact('order'));
    }
}