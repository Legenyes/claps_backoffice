<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Club;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Club::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Club')
            ->setEntityLabelInPlural('Club')
            ->setSearchFields(['id', 'name', 'vatNumber'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $vatNumber = TextField::new('vatNumber');
        $headOfficeAddress = AssociationField::new('headOfficeAddress');
        $clubYears = AssociationField::new('clubYears');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $vatNumber, $headOfficeAddress, $clubYears];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $vatNumber, $headOfficeAddress, $clubYears];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $vatNumber, $headOfficeAddress, $clubYears];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $vatNumber, $headOfficeAddress, $clubYears];
        }
    }
}
