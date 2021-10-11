<?php

declare(strict_types=1);

namespace App\Controller\EasyAdmin;

use App\Entity\ClothesOpportunity;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClothesOpportunityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesOpportunity::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Opportunity')
            ->setEntityLabelInPlural('Opportunities')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnDetail(),
            TextField::new('name'),
            AssociationField::new('clothesPieces')->hideOnForm(),
        ];
    }
}
