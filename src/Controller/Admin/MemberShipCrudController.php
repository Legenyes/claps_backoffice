<?php

namespace App\Controller\Admin;

use App\Entity\MemberShip;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class MemberShipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MemberShip::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('MemberShip')
            ->setEntityLabelInPlural('MemberShip')
            ->setSearchFields(['id', 'subscriptionAmount'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('member'))
            ->add(EntityFilter::new('clubYear'))
            ->add(EntityFilter::new('sections'));
    }

    public function configureFields(string $pageName): iterable
    {
        $clubYear = AssociationField::new('clubYear');
        $member = AssociationField::new('member');
        $sections = AssociationField::new('sections');
        $startDate = DateField::new('startDate');
        $endDate = DateField::new('endDate');
        $subscriptionAmount = NumberField::new('subscriptionAmount');
        $subscriptionPaidAt = DateField::new('subscriptionPaidAt');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $member, $clubYear, $sections, $subscriptionAmount, $subscriptionPaidAt];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $startDate, $endDate, $subscriptionAmount, $subscriptionPaidAt, $clubYear, $member, $sections];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$clubYear, $member, $sections, $startDate, $endDate, $subscriptionAmount, $subscriptionPaidAt];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$clubYear, $member, $sections, $startDate, $endDate, $subscriptionAmount, $subscriptionPaidAt];
        }
    }
}
