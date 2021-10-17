<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Attachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attachment::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
