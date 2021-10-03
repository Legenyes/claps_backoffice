<?php

namespace App\Controller\Admin;

use App\Entity\ClothesPieceStock;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClothesPieceStockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesPieceStock::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClothesPieceStock')
            ->setEntityLabelInPlural('ClothesPieceStock')
            ->setSearchFields(['id', 'status'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $clothesPiece = AssociationField::new('clothesPiece');
        $status = TextField::new('status');
        $colors = AssociationField::new('colors')->setTemplatePath('easy_admin/property_color.html.twig');
        $dressKeeper = AssociationField::new('dressKeeper');
        $personal = Field::new('personal');
        $dressMaker = AssociationField::new('dressMaker');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $clothesPiece, $dressKeeper, $dressMaker, $colors];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $personal, $status, $clothesPiece, $dressMaker, $colors, $dressKeeper];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$clothesPiece, $status, $colors, $dressKeeper, $personal, $dressMaker];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$clothesPiece, $status, $colors, $dressKeeper, $personal, $dressMaker];
        }
    }
}
