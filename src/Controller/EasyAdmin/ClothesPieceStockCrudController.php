<?php

declare(strict_types=1);

namespace App\Controller\EasyAdmin;

use App\Entity\ClothesPieceStock;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            ->setEntityLabelInSingular('Clothes Stock')
            ->setEntityLabelInPlural('Clothes Stock')
            ->setSearchFields(['id', 'status'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnDetail(),
            TextField::new('status'),
            AssociationField::new('colors')->setTemplatePath('admin/field/property_color.html.twig'),
            AssociationField::new('clothesPiece'),
            AssociationField::new('dressKeeper'),
            BooleanField::new('personal'),
            AssociationField::new('dressMaker'),
        ];
    }
}
