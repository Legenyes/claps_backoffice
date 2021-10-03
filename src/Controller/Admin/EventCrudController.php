<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Event')
            ->setEntityLabelInPlural('Event')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $date = DateTimeField::new('date');
        $isHighlight = Field::new('isHighlight');
        $videos = AssociationField::new('videos');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $date, $isHighlight, $videos];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $date, $isHighlight, $videos];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $date, $isHighlight, $videos];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $date, $isHighlight, $videos];
        }
    }
}
