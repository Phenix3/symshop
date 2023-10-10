<?php

namespace App\Controller;

use App\Core\Rating\AverageRatingCalculator;
use App\DataClass\SearchData;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewType;
use App\Form\SearchDataType;
use App\Message\NewProductReviewMessage;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Extra\Markdown\MarkdownInterface;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends BaseController
{
  
    public function __construct(private ProductRepository $productRepository)
    {
    }

    /**
     * @Route("/{slug?}", name="index")
     */
    public function index(Request $request, PaginatorInterface $paginator, Category $category = null)
    {
      $this->pageManager
          ->setVar('page_title', 'Products list')
          ->setVar('page_icon', 'box')
          ->setVar('page_description', '')
          ;
        $searchData = new SearchData();
        $searchData->page = (int) $request->get('page', 1);
        $searchForm = $this->createForm(SearchDataType::class, $searchData);
        $categories = $searchForm->get('categories')->getData();
        if (null !== $category) {
            $categories[] = $category;
        }
        $searchForm->get('categories')->setData($categories);
//        dump($categories, $category, $searchForm->get('categories')->getData());
        $searchForm->handleRequest($request);
        $products = $paginator->paginate(
            $this->productRepository->findSearchQuery($searchData),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('product/index.html.twig', [
          'products' => $products,
          'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("s/{slug}", name="show")
     */
    public function show(string $slug, MarkdownInterface $markdown, AverageRatingCalculator $ratingCalculator)
    {
        $product = $this->productRepository->findWithImages($slug);
      if (!$product->getIsActive() && !$this->isGranted('ROLE_ADMIN')) {
        $this->addFlash('danger', 'alerts.access_denied');
        return $this->redirectToRoute('product_index');
      }

      $averageRating = $ratingCalculator->calculate($product);

      $this->pageManager
          ->setVar('page_title', $product->getName())
          ->setVar('page_icon', 'box')
          ->setVar('page_description', '')
          ;

      $htmlDescription = $markdown->convert($product->getDescription());

      return $this->render('product/show.html.twig', ['product' => $product, 'htmlDescription' => $htmlDescription, 'averageRating' => $averageRating]);
    }

    /**
     * @Route("/{slug}/reviews", name="review", methods={"GET"})
     */
    public function reviews(Product $product): Response
    {
      return $this->render('product/reviews.html.twig', [
        'product' => $product
      ]);
    }

    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/{slug}/reviews/new", name="review_new")
     */
    public function newReview(Product $product, Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            /** @var User $author */
            $author = $this->getUser();
            $review
                ->setProduct($product)
                ->setStatus(Review::REVIEW_STATUS_PENDING)
                ->setAuthor($author);

            $manager->persist($review);
            $manager->flush();
            $this->dispatchMessage(new NewProductReviewMessage($review, $product));

            $this->addFlash('success', 'alerts.review_created');
            return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
        }

        return $this->render('product/review/new.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);
    }

    /**
     * @Route("/{id}/reviews/change-status", name="review_status")
     */
    public function changeReviewStatus(Review $review, Request $request): Response
    {

        if ($request->isXmlHttpRequest()) {
            $content = $request->getContent();
//            dd($content);
            $status = \json_decode($content, true, 512, JSON_THROW_ON_ERROR)['status'];
        } else {
            $status = $request->request->get('status');
        }
        $review->setStatus($status);
        $this->getDoctrine()->getManager()->flush();

        return $request->isXmlHttpRequest() ?
            $this->json([
                'message' => 'Status changed'
            ]) :
            $this->redirectToRoute('product_review');
    }
}
