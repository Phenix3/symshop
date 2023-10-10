<?php

namespace App\Controller\EasyAdmin;

use App\Admin\Field\FileField;
use App\Entity\Product;
use App\Form\Type\AttachmentType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addWebpackEncoreEntry('easyadmin')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),
            MoneyField::new('price')->setCurrency('XAF'),
            NumberField::new('weight')->hideOnIndex(),
            BooleanField::new('isActive'),
            NumberField::new('quantity'),
            NumberField::new('quantityAlert')->hideOnIndex(),
            TextEditorField::new('description')->hideOnIndex(),
            ImageField::new('image')
                ->setFormType(AttachmentType::class)
                ->setUploadDir('public/uploads/attachments')
                ->setBasePath('uploads/attachments')
                ->hideOnForm(),
            FileField::new('image')->setFormType(AttachmentType::class)->onlyOnForms(),
            TextareaField::new('metaKeywords')->hideOnIndex(),
            TextareaField::new('metaDescription')->hideOnIndex(),
        ];
    }

}
