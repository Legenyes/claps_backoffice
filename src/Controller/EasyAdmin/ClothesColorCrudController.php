<?php

namespace App\Controller\EasyAdmin;

use App\Entity\ClothesColor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClothesColorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesColor::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClothesColor')
            ->setEntityLabelInPlural('ClothesColor')
            ->setSearchFields(['id', 'name', 'code'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $code = TextField::new('code')->setTemplatePath('easy_admin/property_color.html.twig');
        $id = IntegerField::new('id', 'ID');
        $clothesPieceStocks = AssociationField::new('clothesPieceStocks');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $code];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $code, $clothesPieceStocks];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $code];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $code];
        }
    }
}
