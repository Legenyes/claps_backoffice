<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesTexture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            ->setEntityLabelInSingular('clothe_texture.crud.title.singular')
            ->setEntityLabelInPlural('clothe_texture.crud.title.plural')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnDetail(),
            TextField::new('name', 'word.name'),
        ];
    }
}
