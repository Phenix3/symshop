<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('description'),
            NumberField::new('lft'),
            NumberField::new('lvl'),
            NumberField::new('rgt'),
            AssociationField::new('root')->setFormTypeOptions([
                'class' => Category::class
            ]),
            AssociationField::new('parent')->setFormTypeOptions([
                'class' => Category::class
            ]),
            BooleanField::new('enabled')->renderAsSwitch(),
        ];
    }

}
