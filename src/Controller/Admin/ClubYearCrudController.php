<?php

namespace App\Controller\Admin;

use App\Entity\ClubYear;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ClubYearCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClubYear::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClubYear')
            ->setEntityLabelInPlural('ClubYear')
            ->setSearchFields(['id'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $dateStart = DateField::new('dateStart');
        $dateStop = DateField::new('dateStop');
        $isActive = Field::new('isActive');
        $club = AssociationField::new('club');
        $memberShips = AssociationField::new('memberShips');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $dateStart, $dateStop, $isActive, $club, $memberShips];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $dateStart, $dateStop, $isActive, $club, $memberShips];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$dateStart, $dateStop, $isActive, $club, $memberShips];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$dateStart, $dateStop, $isActive, $club, $memberShips];
        }
    }
}
