<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{

    public function __construct(private ProductRepository $productRepository)
    {
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $products = $this->productRepository->findLatests(6);
        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/page/{slug}", name="page")
     */
    public function page(Page $page): Response
    {
        return $this->render('home/page.html.twig', ['page' => $page]);
    }
}
