<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\Club;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Club::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Club')
            ->setEntityLabelInPlural('Club')
            ->setSearchFields(['id', 'name', 'vatNumber'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            FormField::addPanel('Club Details'),
            IDField::new('id', 'ID')->onlyOnDetail(),
            TextField::new('name'),
            TextField::new('vatNumber'),

            FormField::addPanel('Club Headoffice address')->collapsible(),
            TextField::new('headOfficeAddress.street')->hideOnIndex(),
            TextField::new('headOfficeAddress.streetNumber')->hideOnIndex(),
            TextField::new('headOfficeAddress.streetBox')->hideOnIndex(),
            TextField::new('headOfficeAddress.zipCode')->hideOnIndex(),
            TextField::new('headOfficeAddress.city')->hideOnIndex(),
            CountryField::new('headOfficeAddress.country')->hideOnIndex(),
        ];
    }
}
