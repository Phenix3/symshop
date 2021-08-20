<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\ProductCrudData;
use App\Admin\Form\ProductForm;
use App\Entity\Attachment;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends CrudController
{
    protected string $templatePath = 'product';
    protected string $menuItem = 'product';
    protected string $entity = Product::class;
    protected string $routePrefix = 'admin_product';
    protected string $searchField = 'name';

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        /** @var EntityRepository */
        $repo = $this->getRepository();
        $query = $repo
                ->createQueryBuilder('row')
                ->leftJoin('row.image', 'image')
                ->addSelect('image');
        return $this->crudIndex($query);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $data = new ProductCrudData($product);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Product $product): Response
    {
        return $this->crudDelete($product);
    }

    /**
     * @Route("/{id}", name="edit")
     */
    public function edit(Product $product, Request $request): Response
    {
        $data = new ProductCrudData($product);
        $old = clone $product;
        dump($data);
        $originalImages = new ArrayCollection();

        foreach ($product->getImages() as $image) {
            $originalImages->add($image);
        }

        $form = $this->createForm(ProductForm::class, $data);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $data->getEntity();
            foreach ($originalImages as $image) {
                /** @var Attachment $image */
                if (false === $entity->getImages()->contains($image)) {
                    $this->em->remove($image);
                }
            }
            $categories = $form->get('categories')->getData();
            dump($originalImages, $categories);
            foreach ($categories as $category) {
                /** @var Category $category */
                $entity->addCategory($category);
                $category->addProduct($product);
                $this->em->persist($category);
            }
            $this->em->persist($entity);
            $data->hydrate();
            dump($data, $entity);
            $this->em->flush();

            if ($this->events['update'] ?? null) {
                $this->eventDispatcher->dispatch(new $this->events['update']($entity, $old));
            }

            $this->addFlash(
                'success',
                'alerts.content_updated'
            );

            return $this->redirectToRoute($this->routePrefix . '_index');

        }

        return $this->render("admin/{$this->templatePath}/edit.html.twig",[
            'form' => $form->createView(),
            'entity' => $data->getEntity(),
            'menu' => $this->menuItem
        ]);
    }
}
