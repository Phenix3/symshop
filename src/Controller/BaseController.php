<?php

namespace App\Controller;

use App\Service\PageManagerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected $pageManager;

    /**
     * @required
     *
     * @param PageManagerService $pageManager
     *
     * @return void
     */
    public function setPageManager(PageManagerService $pageManager)
    {
        $this->pageManager = $pageManager;
    }

    /**
     * Renders a view and sets the appropriate status code when a form is listed in parameters.
     *
     * If an invalid form is found in the list of parameters, a 422 status code is returned.
     */
    protected function renderForm(string $view, array $parameters = [], Response $response = null): Response
    {
        if (null === $response) {
            $response = new Response();
        }

        foreach ($parameters as $k => $v) {
            if ($v instanceof FormView) {
                throw new \LogicException(sprintf('Passing a FormView to "%s::renderForm()" is not supported, pass directly the form instead for parameter "%s".', get_debug_type($this), $k));
            }

            if (!$v instanceof FormInterface) {
                continue;
            }

            $parameters[$k] = $v->createView();

            if (200 === $response->getStatusCode() && $v->isSubmitted() && !$v->isValid()) {
                $response->setStatusCode(422);
            }
        }

        return $this->render($view, $parameters, $response);
    }
}
