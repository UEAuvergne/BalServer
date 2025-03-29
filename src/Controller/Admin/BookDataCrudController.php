<?php

namespace App\Controller\Admin;

use App\Entity\BookData;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookData::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('ean'),
            TextField::new('title'),
            TextField::new('author_name'),
        ];
    }
}
