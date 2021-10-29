<?php

namespace App\Controller;

use App\Form\CartItemType;
use App\Form\Type\CartCollectionType;
use App\Repository\ProductRepository;
use App\Service\Cart\CartData;
use App\Service\Cart\CartService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add($id, Request $request, ProductRepository $productRepository)
    {
        $cartItemForm = $this->createForm(CartItemType::class, new CartData());
        $cartItemForm->handleRequest($request);

        $quantity = $cartItemForm->get('quantity')->getData();
        $product  = $productRepository->find($id);
        // dd($product, $quantity);
        $this->cartService->add($id, $product->getName(), $product->getPrice(), $quantity, $product);
        
        $this->addFlash('success', 'alerts.product_added_to_cart');

        if($request->isXmlHttpRequest()) {
          return $this->json([
            'reload' => true
          ]);
        }
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository, Request $request)
    {
      $cart = $this->getCart();
      // \dump($cart);
      $items = [];
      foreach ($cart as $item) {
        $el = new CartData();
        $el->quantity = $item->quantity;
        $el->id = $item->id;
        $items[$item->id] = $el;
      }
        $cartCollectionForm = $this->createForm(CartCollectionType::class, ['items' => $items]);
        $cartCollectionForm->handleRequest($request);
        $submitted = $cartCollectionForm->isSubmitted();
        $valid = $submitted && $cartCollectionForm->isValid();
        if ($valid) {
          
          foreach ($cartCollectionForm->get('items')->getData() as $item) {
              dump($item->id);
              $this->cartService->update($item->id, [
                'quantity' => ['relative' => false, 'value' => $item->quantity]
              ]);
          }
          $this->addFlash(
            'success',
            'alerts.cart_updated'
          );
          return $this->redirectToRoute('cart_index');
        }
        $request->isXmlHttpRequest();
        
        if($request->isXmlHttpRequest()) {
          return $this->json([
            'cart'  => $cart,
            'total' => $this->cartService->getTotal(),
          ]);
        }
        dump($cart);
        return $this->render('cart/index.html.twig', [
            'cart'  => $cart,
            'total' => $this->cartService->getTotal(),
            'form' => $cartCollectionForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}/remove", name="remove", methods={"DELETE"})
     */
    public function remove($id, Request $request)
    {
        $this->cartService->remove($id);
        if ($request->isXmlHttpRequest()) {
          return $this->json([
            'cart'  => $this->cartService->getContent(),
            'total' => $this->cartService->getTotal(),
          ]);
        }
        return $this->redirectToRoute('cart_index');
    }

    public function renderForm($id, UrlGeneratorInterface $urlGenerator, ProductRepository $productRepository)
    {
        $cartItemForm = $this->createForm(CartItemType::class, new CartData(), [
            'action' => $urlGenerator->generate('cart_add', ['id' => $id]),
        ]);

        return $this->render('cart/_form.html.twig', [
            'form' => $cartItemForm->createView(),
            'product' => $productRepository->find($id)
        ]);
    }

    /**
     * @Route("/{id}/update", name="update", methods={"PUT", "POST", "PATCH"})
     *
     * @param string|int $id
     * @param Request $request
     * @param ProductRepository $productRepository
     *
     * @return void
     */
    public function update($id, Request $request, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);
        $requestContent = \json_decode($request->getContent(), true);
        $qte = (int) $requestContent['quantity'];
        $this->cartService->update($id, [
          'quantity' => ['relative' => false, 'value' => $qte]
        ]);
        
        if($request->isXmlHttpRequest()) {
          return $this->json([
            'cart' => $this->cartService->getContent(),
            'total' => $this->cartService->getTotal()
          ]);
        }
        return $this->redirectToRoute('cart_index');
    }

    private function getCart()
    {
      return $this->cartService->getContent();
    }

}
