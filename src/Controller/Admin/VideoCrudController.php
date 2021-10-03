<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class VideoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Video::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Video')
            ->setEntityLabelInPlural('Video')
            ->setSearchFields(['id', 'name', 'url', 'country'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('country')
            ->add(EntityFilter::new('sections'));
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $url = TextField::new('url');
        $event = AssociationField::new('event');
        $sections = AssociationField::new('sections');
        $recordDate = DateTimeField::new('recordDate');
        $country = TextField::new('country')->setTemplatePath('easy_admin/property_country.html.twig');
        $id = IntegerField::new('id', 'ID');
        $playlistVideos = AssociationField::new('playlistVideos');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $event, $sections, $country, $url];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $url, $recordDate, $country, $sections, $playlistVideos, $event];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $url, $event, $sections, $recordDate, $country];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $url, $event, $sections, $recordDate, $country];
        }
    }
}
