<?php

namespace App\Controller\Admin;

use App\Entity\Bal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('creator')->setFormTypeOption('attr', ['required' => 'required']),
        ];
    }
}
