<?php

namespace App\Controller\EasyAdmin;

use App\Entity\RangeValue;
use App\Form\RangeFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class RangeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RangeValue::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('max')->hideOnForm(),
            CollectionField::new('ranges')
                ->setFormTypeOption('mapped', false)
                ->onlyOnForms()
                ->setEntryType(RangeFormType::class),
        ];
    }
    
}
