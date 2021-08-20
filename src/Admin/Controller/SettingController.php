<?php

namespace App\Admin\Controller;

use App\Admin\Event\Setting\SettingCreated;
use App\Admin\Event\Setting\SettingUpdated;
use App\Entity\Setting;
use App\Admin\DataClass\SettingCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/setting", name="setting_")
 */
class SettingController extends CrudController
{
    protected string $templatePath = 'setting';
    protected string $menuItem = 'setting';
    protected string $entity = Setting::class;
    protected string $routePrefix = 'admin_setting';
    protected string $searchField = 'name';
    protected array $events = [
        'create' => SettingCreated::class,
        'update' => SettingUpdated::class
    ];

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->crudIndex($this->getRepository()->createQueryBuilder('row'), 'keyName');
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $setting = new Setting();
        $data = new SettingCrudData($setting);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Setting $setting): Response
    {
        return $this->crudDelete($setting);
    }

    /**
     * @Route("/{id}", name="edit")
     */
    public function edit(Setting $setting): Response
    {
        $data = new SettingCrudData($setting);

        return $this->crudEdit($data);
    }
}
