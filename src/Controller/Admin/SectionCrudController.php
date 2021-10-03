<?php

namespace App\Controller\Admin;

use App\Entity\Section;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Section::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Section')
            ->setEntityLabelInPlural('Section')
            ->setSearchFields(['id', 'name', 'code'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $code = TextField::new('code');
        $memberShips = AssociationField::new('memberShips');
        $id = IntegerField::new('id', 'ID');
        $videos = AssociationField::new('videos');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $code, $memberShips, $videos];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $code, $memberShips, $videos];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $code, $memberShips];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $code, $memberShips];
        }
    }
}
