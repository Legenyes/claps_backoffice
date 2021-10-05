<?php

namespace App\Controller\EasyAdmin;

use App\Entity\ClothesTexture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClothesTextureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesTexture::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClothesTexture')
            ->setEntityLabelInPlural('ClothesTexture')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $id = IntegerField::new('id', 'ID');
        $clothesPieces = AssociationField::new('clothesPieces');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $clothesPieces];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $clothesPieces];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name];
        }
    }
}
