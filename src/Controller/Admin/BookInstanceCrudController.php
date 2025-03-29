<?php

namespace App\Controller\Admin;

use App\Entity\BookInstance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookInstanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookInstance::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('data'),
            AssociationField::new('owner'),
            AssociationField::new('bal'),
            MoneyField::new('price')->setCurrency("EUR"),
            ChoiceField::new('status'),
        ];
    }
}
