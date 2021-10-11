<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Address')
            ->setEntityLabelInPlural('Address')
            ->setSearchFields(['id', 'street', 'streetNumber', 'streetBox', 'zipCode', 'city', 'country'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $street = TextField::new('street');
        $streetNumber = TextField::new('streetNumber');
        $streetBox = TextField::new('streetBox');
        $zipCode = TextField::new('zipCode');
        $city = TextField::new('city');
        $country = TextField::new('country');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $street, $streetNumber, $streetBox, $zipCode, $city, $country];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $street, $streetNumber, $streetBox, $zipCode, $city, $country];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$street, $streetNumber, $streetBox, $zipCode, $city, $country];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$street, $streetNumber, $streetBox, $zipCode, $city, $country];
        }
    }
}
