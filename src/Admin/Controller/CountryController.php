<?php

namespace App\Admin\Controller;

use App\Entity\Country;
use App\Admin\DataClass\CountryCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/country", name="country_")
 */
class CountryController extends CrudController
{
    protected string $templatePath = 'country';
    protected string $menuItem = 'country';
    protected string $entity = Country::class;
    protected string $routePrefix = 'admin_country';
    protected string $searchField = 'name';

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->crudIndex($this->getRepository()->createQueryBuilder('row'), 'name');
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $country = new Country();
        $data = new CountryCrudData($country);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Country $country): Response
    {
        return $this->crudDelete($country);
    }

    /**
     * @Route("/{id}", name="edit")
     */
    public function edit(Country $country): Response
    {
        $data = new CountryCrudData($country);

        return $this->crudEdit($data);
    }
}
