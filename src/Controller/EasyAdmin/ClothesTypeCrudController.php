<?php

namespace App\Controller\EasyAdmin;

use App\Entity\ClothesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClothesTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClothesType')
            ->setEntityLabelInPlural('ClothesType')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $type = AssociationField::new('type');
        $zone = AssociationField::new('zone');
        $id = IntegerField::new('id', 'ID');
        $clothesPieces = AssociationField::new('clothesPieces');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $type, $zone, $clothesPieces];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $type, $zone, $clothesPieces];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $type, $zone];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $type, $zone];
        }
    }
}
