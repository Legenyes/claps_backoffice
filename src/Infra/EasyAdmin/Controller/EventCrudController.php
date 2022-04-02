<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\Event;
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
            ->setEntityLabelInSingular('event.crud.title.singular')
            ->setEntityLabelInPlural('event.crud.title.plural')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name', 'word.name');
        $date = DateTimeField::new('date', 'word.date');
        $vanue = TextField::new('venue', 'vent.properties.venue');
        $isHighlight = Field::new('isHighlight', 'event.properties.is_highlight');
        $videos = AssociationField::new('videos', 'event.crud.title.plural');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $date, $vanue, $isHighlight, $videos];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $date, $vanue, $isHighlight, $videos];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $date, $vanue, $isHighlight, $videos];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $date, $vanue, $isHighlight, $videos];
        }
    }
}
